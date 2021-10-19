<?php

namespace App\Http\Controllers;

use App\Repositories\StateRepository;

class StateController extends Controller
{
    private StateRepository $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

}
