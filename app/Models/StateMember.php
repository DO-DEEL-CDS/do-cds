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

    protected $fillable = [
        'year',
        'type',
        'name',
        'email',
        'position',
        'state_code',
        'phone_number',
        'instagram',
        'batch',
        'facebook',
    ];

    protected $casts = [
        'type' => StateMembershipType::class,
        'batch' => Batch::class,
        'year' => 'date:Y'
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
