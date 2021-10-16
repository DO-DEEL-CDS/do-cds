<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function __invoke(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $request->authenticate();
        return $this->success('Login Successful', $authService->loginUser((string) $request->post('device_id')));
    }
}
