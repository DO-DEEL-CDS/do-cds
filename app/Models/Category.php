<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
            'title',
            'slug'
    ];

    protected $hidden = [
            'created_at',
            'updated_at'
    ];

    public function articles(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
