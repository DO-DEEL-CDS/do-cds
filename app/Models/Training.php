<?php

namespace App\Models;

use App\Enums\TrainingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Training extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => TrainingStatus::class
    ];

    protected $hidden = [
        'batch',
        'deleted_at',
        'attendance_time',
        'created_by'
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
    }

    // Trainer should be just string
//    public function trainer()
//    {
//        return $this->belongsTo(User::class);
//    }
}
