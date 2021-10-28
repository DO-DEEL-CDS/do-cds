<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->userRepository->getUsers($request->all()));
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userRepository->createAccount($request->all());
        return $this->success($user, 'User Created', 201);
    }

    public function show(User $user): JsonResponse
    {
        $user = $this->userRepository->adminGetUser($user);
        return $this->success($user);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user = $this->userRepository->updateUser($user, $request->safe());
        return $this->success($user);
    }
}
