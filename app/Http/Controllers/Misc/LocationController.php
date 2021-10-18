<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\State;

class LocationController extends Controller
{
    public function states()
    {
        $states = State::get(['state_code', 'state_name', 'other_name']);
        return $this->success($states);
    }
}
