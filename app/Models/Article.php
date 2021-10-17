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
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'state_code',
        'category_id'
    ];

    protected $with = [
        'author:id,name',
        'category:id,title'
    ];

    protected $casts = [
        'status' => ArticleStatus::class
    ];

    private $uploadable = ['image'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, array $search): void
    {
        if (!empty($search['category'])) {
            $query->where('category_id', $search['category']);
        }
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', ArticleStatus::Published);
    }
}
