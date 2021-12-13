<?php

namespace App\Http\Requests;

use App\Rules\RegistrationSecret;
use App\Traits\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateCorperAccountRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
                'name' => ['required', 'string', 'max:191'],
                'deployed_state' => ['required', 'exists:states,state_code'],
                'call_up_number' => ['required', 'string', 'max:20'],
                'password' => $this->passwordRules(),
                'secret' => new RegistrationSecret(),
                'device_id' => ['sometimes', 'present', 'uuid'],
        ];
    }
}
