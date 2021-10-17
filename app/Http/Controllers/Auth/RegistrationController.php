<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCorperAccount;
use App\Http\Requests\CreateCorperAccountRequest;
use App\Repositories\ProspectRepository;
use App\Services\AuthService;
use App\Services\ProspectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    /**
     * @var ProspectService
     */
    private $prospectService;
    /**
     * @var ProspectRepository
     */
    private $prospectRepository;
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(ProspectRepository $prospectRepository, AuthService $authService)
    {
        $this->prospectService = new ProspectService($prospectRepository);
        $this->prospectRepository = $prospectRepository;
        $this->authService = $authService;
    }

    public function getStarted(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'exists:prospects,email']
        ]);

        abort_if($this->prospectRepository->hasAccount($validated['email']), Response::HTTP_BAD_REQUEST, 'Account Already Exist');
        $this->prospectService->sendOTP($validated['email']);
        return $this->success('OTP Sent');
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:prospects,email'],
            'otp' => [
                'required', "digits:4",
                Rule::exists('prospects', 'verify_token')->where('email', $request->input('email'))
            ]
        ]);

        abort_if(!$this->prospectRepository->isOTPValid($validated['email']), Response::HTTP_BAD_REQUEST, 'OTP Expired, Request a new one');
        return $this->success('Email Verified', $this->prospectService->registrationSecret($validated['email']));
    }

    public function createAccount(CreateCorperAccountRequest $request): JsonResponse
    {
        $user = $this->authService->createAccount($request->validated());
        return $this->success('Registration Completed', $user, Response::HTTP_CREATED);
    }
}
