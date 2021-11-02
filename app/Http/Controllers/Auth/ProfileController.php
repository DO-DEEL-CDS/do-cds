<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        $fullProfile = $this->userRepository->getFUllUserProfile($user);
        return $this->success($fullProfile);
    }

    public function update(UpdateProfile $request): JsonResponse
    {
        $user = $this->userRepository->updateUser($request->user(), $request->safe());
        return $this->success($user, 'Profile Updated');
    }

    public function updateNotificationsRead(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'exists:notifications,id'],
        ]);
        $this->userRepository->markNotificationsRead(auth()->user(), $validated['ids']);
        return $this->success();
    }

    public function getNotifications(Request $request): JsonResponse
    {
        $notifications = $this->userRepository->getNotifications(auth()->user(), $request->all());
        return $this->success($notifications);
    }
}
