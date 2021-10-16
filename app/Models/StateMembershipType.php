<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StateMembershipType extends Pivot
{
    protected $guarded = ['id'];
}
