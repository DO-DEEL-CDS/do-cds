<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasFactory;

    protected $hidden = [
        'pivot',
        'guard_name',
        'created_at',
        'updated_at',
    ];
}
