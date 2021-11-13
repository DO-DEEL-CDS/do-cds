<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NyscStateCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return preg_match("/^[a-zA-Z]{2}\/\d{2}[abcABC]\/\d{4}$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid State code provided.';
    }
}
