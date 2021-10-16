<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMember extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }
}
