<?php

namespace App\Models;

use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Resource extends Model
{
    use HasFactory, ModelDoesUploads;

    public $uploadable = [
        'attachment'
    ];

    protected $fillable = [
        'attachment',
    ];

    protected $hidden = [
        'resourceable_id',
        'resourceable_type',
        'updated_at',
    ];

    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }

    public function users(): HasMany
    {
        return $this->hasMany(Profile::class)->with('user');
    }
}
