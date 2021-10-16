<?php

namespace App\Repositories;

use App\Models\User;
use DB;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
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
    public function creteAccount(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->addUser($data);
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
        $token = $user->createToken($user->name);
        return explode('|', $token->plainTextToken)[1];
    }

    public function getCurrentUser(string $deviceId, bool $withNewToken = false): User
    {
        $user = request()->user('sanctum')->load(['profile', 'permissions']);

        if ($deviceId) {
            $user->device_id = $deviceId;
            $user->update();
        }

        if ($withNewToken) {
            $this->deleteAPiIKeys($user);
            $user->api_token = $this->generateApiKey($user);
        }
        return $user;
    }

    public function deleteAPiIKeys(User $user): string
    {
        $user->tokens()->delete();
        return true;
    }
}
