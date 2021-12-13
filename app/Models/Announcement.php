<?php

namespace App\Models;

use App\Enums\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'content',
            'state_code',
            'year',
            'batch',
            'user_id',
            'author_id',
    ];

    protected $casts = [
            'batch' => Batch::class,
            'year' => 'date:Y'
    ];

    protected $hidden = [
            'user_id',
            'author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function corper(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function scopeSearch($query, array $search): void
    {
        if (!empty($search['title'])) {
            $query->where('title', 'like', "{$search['title']}%");
        }

        if (!empty($search['state_code'])) {
            $query->where('state_code', $search['state_code']);
        }
    }
}
