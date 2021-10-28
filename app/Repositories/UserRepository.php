<?php

namespace App\Repositories;

use App\Models\User;
use DB;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\ValidatedInput;
use Throwable;

class UserRepository extends BaseRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * Instantiate repository
     *
     * @param  User  $model
     */
    public function __construct()
    {
        parent::__construct(new User());
    }

    /**
     * @param  array  $data
     * @return User|Model
     * @throws Throwable
     */
    public function createAccount(array $data)
    {
        if (empty($data['password'])) {
            $data['password'] = \Str::random();
        }
        if (!empty($data['deployed_state'])) {
            $data['state_code'] = $data['deployed_state'];
        }

        try {
            DB::beginTransaction();
            $user = $this->addUser($data);
            $user->markEmailAsVerified();
            $this->createProfile($user, $data);
            $user->api_token = $this->generateApiKey($user);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }

    public function addUser(array $data)
    {
        abort_if(User::whereEmail($data['email'])->exists(), Response::HTTP_BAD_REQUEST, 'Account Already Exist');

        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = now();
        return User::create($data);
    }

    public function createProfile(User $user, array $data): User
    {
        $user->profile()->create($data);
        $user->refresh();
        $user->load('profile');
        return $user;
    }

    public function generateApiKey(User $user): string
    {
        $this->deleteAPiIKeys($user);
        $token = $user->createToken($user->name);
        return explode('|', $token->plainTextToken)[1];
    }

    public function deleteAPiIKeys(User $user): string
    {
        $user->tokens()->delete();
        return true;
    }

    public function findByEmail(string $email): User
    {
        return User::whereEmail($email)->firstOrFail();
    }

    public function setPassword(User $user, $password): User
    {
        $user->update([
            'password' => Hash::make($password)
        ]);

        return $user;
    }

    public function getCurrentUser(string $deviceId, bool $withNewToken = false): User
    {
        $user = $this->getUserData(request()->user(), true);

        if ($deviceId) {
            $user->device_id = $deviceId;
            $user->update();
        }

        if ($withNewToken) {
            $user->api_token = $this->generateApiKey($user);
        }
        return $user;
    }

    public function getUserData(User $user, bool $withAuth = false): User
    {
        $user->load(['profile']);

        if ($withAuth) {
            $user->load(['permissions', 'roles']);
        }

        return $user;
    }

    public function updateUser(User $user, ValidatedInput $data): User
    {
        $user->update($data->all());

        $user->profile()->update($data->only('photo', 'deployed_state', 'nysc_call_up_number', 'nysc_state_code', 'phone_number'));
        $user->refresh();
        return $this->getUserData($user);
    }

    public function getUsers(array $search)
    {
        return User::query()
            ->with('profile')
            ->role('corper')
            ->search($search)
            ->simplePaginate();
    }

    public function adminGetUser(User $user): User
    {
        return $user->load(['profile', 'businesses', 'permissions', 'roles', 'attendance']);
    }

}
