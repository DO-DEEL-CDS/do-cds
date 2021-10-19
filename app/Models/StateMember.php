<?php

namespace App\Models;

use App\Enums\Batch;
use App\Enums\StateMembershipType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StateMember extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => StateMembershipType::class,
        'batch' => Batch::class,
    ];

    protected $hidden = [
        'user_id'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function scopeType(Builder $builder, StateMembershipType $type): void
    {
        $builder->where('type', $type->key);
    }
}
