<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use App\Repositories\ProspectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Throwable;

class AuthService extends BaseService
{
    /**
     * @var ProspectRepository
     */
    private $prospectRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

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

    /**
     * @throws Throwable
     */
    public function createAccount(array $data)
    {
        $prospect = $this->prospectRepository->getProspectFromSecret($data['secret']);
        abort_if(!$prospect, Response::HTTP_BAD_REQUEST, 'invalid secret Provided');

        $userData = collect($data)->only(['name', 'deployed_state', 'call_up_number', 'password', 'device_id'])->toArray();
        $userData['email'] = $prospect->email;
        $userData['nysc_state_code'] = $prospect->nysc_state_code;
        $userData['nysc_call_up_number'] = $userData['call_up_number'];
        $userData['state_code'] = $userData['deployed_state'];

        return $this->userRepository->creteAccount($userData);
    }

    public function loginUser(string $deviceId): User
    {
        return $this->userRepository->getCurrentUser($deviceId, true);
    }
}
