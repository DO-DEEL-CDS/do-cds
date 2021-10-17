<?php

namespace App\Rules;

use App\Services\AuthService;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class PasswordResetSecret implements Rule
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
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
        try {
            return $this->authService->verifyResetSecret($value);
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Secret provided is invalid.';
    }
}
