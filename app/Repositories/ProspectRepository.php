<?php

namespace App\Repositories;

use App\Enums\ProspectStatus;
use App\Models\Prospect;
use App\Notifications\ApplicationReceived;
use Illuminate\Contracts\Encryption\DecryptException;

class ProspectRepository extends BaseRepository
{
    /** @var */
    protected $model;

    /**
     * Instantiate repository
     */
    public function __construct()
    {
        parent::__construct(new Prospect());
    }

    public function create(array $data): void
    {
        if ($data['deployed_state']) {
            $data['state_code'] = $data['deployed_state'];
        }

        $prospect = Prospect::create($data);
        $prospect->notify(new ApplicationReceived());
    }

    public function findByEmail(string $email)
    {
        return Prospect::whereEmail($email)->firstOrFail();
    }

    public function isApproved(Prospect $prospect): bool
    {
        return $prospect->status->is(ProspectStatus::Approved);
    }

    public function generateToken(string $prospectEmail): Prospect
    {
        $prospect = Prospect::where('email', $prospectEmail)->firstOrFail();
        $prospect->verify_token = generate_otp($prospect);
        $prospect->update();
        return $prospect;
    }

    public function hasAccount(string $prospectEmail): bool
    {
        return Prospect::where('email', $prospectEmail)->has('user')->exists();
    }

    public function isOTPValid(string $prospectEmail): bool
    {
        $prospect = Prospect::where('email', $prospectEmail)->firstOrFail();

        return $prospect->updated_at->isBetween(now()->subtract('s15 minutes'), now());
    }

    public function verifyRegistrationSecret(Prospect $prospect, $secret): bool
    {
        return $this->generateRegistrationSecret($prospect) === $secret;
    }

    public function generateRegistrationSecret(Prospect $prospect): string
    {
        return encrypt($prospect->email . ':' . $prospect->id . $prospect->updated_at->getTimestamp());
    }

    public function getProspectFromSecret($secret)
    {
        try {
            $string = decrypt($secret);
            $data = explode(':', $string);

            if (!isset($data[0]) || $data[0] === '') {
                return false;
            }
        } catch (DecryptException $exception) {
            return false;
        }

        return Prospect::whereEmail($data[0])->firstOrFail();
    }
}
