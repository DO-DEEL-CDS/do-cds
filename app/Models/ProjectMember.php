<?php

namespace App\Models;

use App\Enums\Batch;
use App\Enums\ProjectMemberType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'batch',
        'name',
        'email',
        'position',
        'facebook_link',
        'state_code',
        'phone_number',
        'instagram',
        'type'
    ];

    protected $casts = [
        'batch' => Batch::class,
        'type' => ProjectMemberType::class,
        'year' => 'date:Y',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
