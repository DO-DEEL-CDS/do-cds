<?php

namespace App\Http\Controllers;

class FallbackController extends Controller
{
    public function __invoke()
    {
        return $this->error('Resource not found...', '404');
    }
}
