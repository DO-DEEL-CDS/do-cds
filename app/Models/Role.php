<?php

namespace App\Models;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    protected $hidden = [
        'pivot',
        'guard_name',
        'created_at',
        'updated_at',
    ];
}
