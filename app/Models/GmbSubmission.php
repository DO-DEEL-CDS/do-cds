<?php

namespace App\Models;

use App\Enums\GMBStatus;
use App\Models\Roles\Corper;
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
        'user_id'
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
}
