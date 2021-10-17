<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  LoginRequest  $request
     * @param  AuthService  $authService
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $request->authenticate();
        return $this->success($authService->loginUser((string) $request->post('device_id')), 'Login Successful');
    }
}
