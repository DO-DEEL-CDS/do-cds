<?php

namespace App\Models\Roles;

use App\Extensions\Traits\AuthenticatableRoles;
use App\Extensions\Traits\HasParentModel;
use App\Models\User;

/**
 * @extends User
 */
class Corper extends User
{
    use HasParentModel, AuthenticatableRoles;

    protected static string $role = 'corper';
}
