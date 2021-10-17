<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\PasswordResetSecret;
use App\Services\AuthService;
use App\Traits\PasswordValidationRules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasswordController extends Controller
{
    use PasswordValidationRules;

    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function sendPasswordResetCode(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'exists:users']
        ]);

        $this->authService->sendPasswordResetCode($request->post('email'));
        return $this->success('Password Reset Code Sent');
    }

    public function verifyPasswordResetCode(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users'],
            'code' => [
                'required', 'digits:4',
                Rule::exists('password_resets', 'token')->where('email', $request->post('email'))
            ],
        ]);

        $user = $this->authService->verifyPasswordResetCode($request->only(['email', 'code']));
        $data['secret'] = $this->authService->generateResetSecret($user);
        return $this->success('verified OTP, continue to Set new password', $data);
    }

    public function setNewPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'password' => $this->passwordRules(),
            'secret' => ['required', 'string', new PasswordResetSecret($this->authService)],
            'device_id' => ['sometimes', 'nullable', 'string']
        ]);

        $data = $this->authService->setPassword($request->only('secret', 'password', 'device_id'));
        return $this->success('Password Reset Completed.', $data);
    }
}
