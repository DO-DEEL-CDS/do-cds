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
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function scopeType(Builder $builder, StateMembershipType $type): void
    {
        $builder->where('type', $type);
    }

    public function scopeSearch(Builder $builder, array $search)
    {
        if (!empty($search['type'])) {
            $type = StateMembershipType::fromValue((int) $search['type']);
            $builder->where('state_members.type', $type);
        }

        if (!empty($search['batch'])) {
            $batch = Batch::fromValue($search['batch']);
            $builder->where('state_members.batch', $batch);
        }

        if (!empty($search['year'])) {
            $builder->where('year', '=', $search['year']);
        }
    }
}
