<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    use HasFactory;

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

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
