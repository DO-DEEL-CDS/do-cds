<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory, ModelDoesUploads;

    protected $guarded = ['id'];

    protected $fillable = [
        'image',
        'title',
        'content',
        'category_id',
        'state_code',
        'status',
        'is_featured'
    ];

    protected $hidden = [
        'updated_at',
        'state_code',
        'category_id',
        'image'
    ];

    protected $with = [
        'author:id,name',
        'category:id,title',
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
        'is_featured' => 'boolean'
    ];

    protected $appends = [
        'image_url'
    ];

    private array $uploadable = ['image'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute($value)
    {
        return url($this->image);
    }

    public function scopeSearch($query, array $search): void
    {
        if (isset($search['featured'])) {
            $query->where('is_featured', true);
        }

        if (!empty($search['category'])) {
            $query->where('category_id', $search['category']);
        }

        if (!empty($search['title'])) {
            $query->where('title', 'like', "{$search['title']}%");
        }

        if (!empty($search['state_code'])) {
            $query->where('state_code', $search['state_code']);
        }
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', ArticleStatus::Published);
    }
}
