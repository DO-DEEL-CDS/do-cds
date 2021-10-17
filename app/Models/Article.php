<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'state_code',
        'status'
    ];

    protected $with = [
        'author:id,name',
        'category:title'
    ];

    protected $casts = [
        'status' => ArticleStatus::class
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
