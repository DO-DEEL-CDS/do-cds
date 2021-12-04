<?php

namespace App\Models;

use App\Enums\ProspectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Prospect extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'nysc_state_code',
        'verify_token',
        'state_code',
        'intro_video',
        'status'
    ];

    protected $casts = [
        'status' => ProspectStatus::class
    ];

    protected $hidden = [
        'verify_token'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function scopeFilter(Builder $builder, array $search): void
    {
        if (!empty($search['search'])) {
            $builder->where('name', 'like', $search['search'] . '%')
                ->orWhere('email', 'like', $search['search'] . '%')
                ->orWhere('nysc_state_code', 'like', $search['search'] . '%');
        }

        if (!empty($search['status'])) {
            $status = ProspectStatus::fromValue((int) $search['status']);
            $builder->where('status', $status);
        }

        if (!empty($search['state'])) {
            $builder->where('state_code', $search['state']);
        }

        if (!empty($search['month'])) {
            $builder->whereMonth('created_at', $search['month']);
        }

        if (!empty($search['date'])) {
            $builder->whereDate('created_at', $search['date']);
        }
    }
}
