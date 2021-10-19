<?php

namespace App\Models;

use App\Extensions\Traits\ModelDoesUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    use HasFactory, ModelDoesUploads;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'logo',
        'email',
        'location'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public $uploadable = [
        'logo'
    ];

    public function employments(): HasMany
    {
        return $this->hasMany(Employment::class);
    }
}
