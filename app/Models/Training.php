<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function attendance()
    {
        return $this->hasMany(TrainingAttendance::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class);
    }
}
