<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected $hidden = [
            'id',
    ];

    public function getRouteKeyName(): string
    {
        return 'state_code';
    }

    /**
     * @return HasMany<StateMember::class>
     */
    public function members(): HasMany
    {
        return $this->hasMany(StateMember::class, 'state_code', 'state_code');
    }

}
