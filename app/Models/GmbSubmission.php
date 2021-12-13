<?php

namespace App\Models;

use App\Enums\GMBStatus;
use App\Models\Roles\Corper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GmbSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
            'status',
            'business_email',
            'business_name',
            'business_owner',
            'owner_gender',
            'reject_reason',
            'user_id',
            'project_id',
    ];

    protected $hidden = [
            'approved_by'
    ];

    protected $casts = [
            'status' => GMBStatus::class
    ];

    public function corper(): BelongsTo
    {
        return $this->belongsTo(Corper::class, 'user_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeSearch(Builder $builder, array $search): void
    {
        if (!empty($search['business_name'])) {
            $builder->where('business_name', 'like', $search['business_name'] . '%s');
        }

        if (!empty($search['business_owner'])) {
            $builder->where('business_name', 'like', $search['business_name'] . '%s');
        }

        if (!empty($search['owner_gender'])) {
            $builder->where('business_name', 'like', $search['business_name'] . '%s');
        }

        if (!empty($search['user_id'])) {
            $builder->where('user_id', '=', $search['user_id']);
        }
    }
}
