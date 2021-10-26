<?php

namespace App\Models;

use App\Enums\Batch;
use App\Enums\ProjectMemberType;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'overview',
        'guide',
        'batch',
        'year',
        'type',
    ];

    protected $casts = [
        'type' => ProjectType::class,
        'status' => ProjectStatus::class,
        'year' => 'date:Y',
        'batch' => Batch::class,
    ];

    protected $hidden = [
        'user_id',
        'batch',
        'year',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function excos(): HasMany
    {
        return $this->hasMany(ProjectMember::class)->where('type', ProjectMemberType::Exco());
    }

    public function businesses(): HasMany
    {
        return $this->hasMany(GmbSubmission::class);
    }

    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', ProjectStatus::Active());
    }
}
