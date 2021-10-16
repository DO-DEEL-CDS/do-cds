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
    public function passes($attribute, $value)
    {
        $prospectRepository = new ProspectRepository();
        $prospect = $prospectRepository->getProspectFromSecret($value);

        if (!$prospect || $prospect->updated_at->isBefore(now()->subtract("30 minutes"))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Registration Secret is Expired. Kindly start again.';
    }
}
