<?php

namespace App\Rules;

use App\Repositories\ProspectRepository;
use Illuminate\Contracts\Validation\Rule;

class RegistrationSecret implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $prospectRepository = new ProspectRepository();
        $prospect = $prospectRepository->getProspectFromSecret($value);

        return !(!$prospect || $prospect->updated_at->isBefore(now()->subtract("30 minutes")));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The Registration Secret is Invalid. Start a fresh registration.';
    }
}
