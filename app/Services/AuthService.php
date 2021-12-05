<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\PasswordChanged;
use App\Notifications\PasswordReset;
use App\Repositories\ProspectRepository;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Response;

class AuthService extends BaseService
{

    private ProspectRepository $prospectRepository;

    private UserRepository $userRepository;

    /**
     * AuthService constructor.
     * @param  ProspectRepository  $prospectRepository
     * @param  UserRepository  $userRepository
     */
    public function __construct(ProspectRepository $prospectRepository, UserRepository $userRepository)
    {
        $this->prospectRepository = $prospectRepository;
        $this->userRepository = $userRepository;
    }


    public function createAccount(array $data)
    {
        $prospect = $this->prospectRepository->getProspectFromSecret($data['secret']);
        abort_if(!$prospect, Response::HTTP_BAD_REQUEST, 'invalid secret Provided');

        $userData = collect($data)->only(['name', 'deployed_state', 'call_up_number', 'password', 'device_id'])->toArray();
        $userData['email'] = $prospect->email;
        $userData['nysc_state_code'] = $prospect->nysc_state_code;
        $userData['nysc_call_up_number'] = $userData['call_up_number'];
        $userData['state_code'] = $userData['deployed_state'];

        return $this->userRepository->createAccount($userData);
    }

    public function loginUser(string $deviceId): User
    {
        $user = $this->userRepository->getCurrentUser($deviceId, true);
        $user->load(['profile', 'roles', 'permissions']);
        return $user;
    }

    public function sendPasswordResetCode(string $email): void
    {
        $user = $this->userRepository->findByEmail($email);
        $code = $user->getPasswordResetCode();
        $user->notify(new PasswordReset($code));
    }

    public function verifyPasswordResetCode(array $data): User
    {
        $user = $this->userRepository->findByEmail($data['email']);
        $code = $user->getPasswordResetCode();

        abort_if((int) $code !== $data['code'], Response::HTTP_BAD_REQUEST, 'Reset Code Expired');

        return $user;
    }

    public function setPassword(array $data): User
    {
        $user = $this->userRepository->setPassword($this->getUserFromSecret($data['secret']), $data['password']);
        Auth::login($user);
        $user->deletePasswordResetCode();
        $user->notify(new PasswordChanged());
        return $this->userRepository->getCurrentUser($data['device_id'] ?? false);
    }

    public function getUserFromSecret(string $secret): User
    {
        try {
            $data = decrypt($secret);
        } catch (DecryptException $e) {
            abort(400, 'Invalid Secret Provided');
            exit('Invalid Secret Provided');
        }
        return $this->userRepository->findByEmail($data['email']);
    }

    public function verifyResetSecret($secret): bool
    {
        $user = $this->getUserFromSecret($secret);
        $data = decrypt($secret);
        return $data['code'] === $user->getPasswordResetCode();
    }

    public function generateResetSecret(User $user): string
    {
        $data['code'] = $user->getPasswordResetCode();
        $data['email'] = $user->email;
        return encrypt($data);
    }
}
