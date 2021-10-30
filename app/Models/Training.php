<?php

namespace App\Models;

use App\Enums\TrainingStatus;
use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use HasFactory, SoftDeletes, ModelDoesUploads;

    protected $fillable = [
        'status',
        'batch',
        'title',
        'overview',
        'start_time',
        'attendance_time',
        'tutor',
        'live_video',
    ];

    protected $casts = [
        'status' => TrainingStatus::class,
    ];

    protected $dates = [
        'start_time' => 'datetime',
        'attendance_time' => 'datetime',
    ];

    protected $hidden = [
        'batch',
        'deleted_at',
        'created_by',
        'start_time'
    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(TrainingAttendance::class);
    }

    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }


    public function scopeSearch(Builder $query, array $search): void
    {
        if (!empty($search['title'])) {
            $query->where('title', 'like', $search['title'] . '%');
        }

        if (!empty($search['order']) && in_array($search['order'], ['asc', 'desc'])) {
            $query->orderBy('created_at', $search['order']);
        }

        if (!empty($search['upcoming'])) {
            $query->orderBy('start_time', 'desc');
            $query->where('start_time', '>=', now());
            $query->orWhere('status', '!=', TrainingStatus::Closed);
        }


        if (!empty($search['status'])) {
            $status = TrainingStatus::fromValue($search['status']);
            $query->where('status', '=', $status);
        }
    }
}
