<?php

namespace App\Services;

use App\Models\Prospect;
use App\Notifications\ProspectVerification;
use App\Repositories\ProspectRepository;

class ProspectService extends BaseService
{
    private ProspectRepository $repository;

    /**
     * @param  ProspectRepository  $repository
     */
    public function __construct(ProspectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sendOTP(string $prospectEmail): void
    {
        $prospect = $this->repository->generateToken($prospectEmail);
        $prospect->notify(new ProspectVerification($prospect->verify_token));
    }

    public function registrationSecret(string $prospectEmail): array
    {
        $prospect = Prospect::whereEmail($prospectEmail)->firstOrFail();
        $secret = $this->repository->generateRegistrationSecret($prospect);

        return [
                'registration_secret' => $secret
        ];
    }
}
