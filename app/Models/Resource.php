<?php

namespace App\Models;

use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{
    use HasFactory, ModelDoesUploads;

    public array $uploadable = [
        'attachment'
    ];

    protected $fillable = [
        'attachment',
        'filename'
    ];

    protected $hidden = [
        'resourceable_id',
        'resourceable_type',
        'updated_at',
        'attachment',
    ];

    protected $appends = [
        'attachment_url',
        'size'
    ];

    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }

    public function users(): HasMany
    {
        return $this->hasMany(Profile::class)->with('user');
    }

    public function getPathAttribute()
    {
        return str_replace('storage', '', $this->attachment);
    }

    public function getSizeAttribute(): int
    {
        return Storage::size($this->path);
    }

    public function getAttachmentUrlAttribute()
    {
        return url($this->attachment);
    }
}
