<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    private ProspectService $prospectService;

    private ProspectRepository $prospectRepository;

    private AuthService $authService;

    public function __construct(ProspectRepository $prospectRepository, AuthService $authService)
    {
        $this->prospectService = new ProspectService($prospectRepository);
        $this->prospectRepository = $prospectRepository;
        $this->authService = $authService;
    }

    public function getStarted(Request $request): JsonResponse
    {
        $validated = $this->validate($request, ['email' => ['required', 'exists:prospects,email']], [
            'email.exists' => 'The provided email does not exist in our record. Kindly ensure you already enrolled on the website'
        ]);

        $prospect = $this->prospectRepository->findByEmail($validated['email']);

        abort_if(!$this->prospectRepository->isApproved($prospect), Response::HTTP_BAD_REQUEST, 'Your Application Has not been Approved');
        abort_if($this->prospectRepository->hasAccount($validated['email']), Response::HTTP_BAD_REQUEST, 'Account Already Exist');

        $this->prospectService->sendOTP($validated['email']);

        return $this->success([], 'OTP Sent');
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
        return $this->success($this->prospectService->registrationSecret($validated['email']), 'Email Verified');
    }

    public function createAccount(CreateCorperAccountRequest $request): JsonResponse
    {
        $user = $this->authService->createAccount($request->validated());
        return $this->success($user, 'Registration Completed', Response::HTTP_CREATED);
    }
}
