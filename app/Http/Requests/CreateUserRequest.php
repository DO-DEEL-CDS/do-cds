<?php

namespace App\Http\Requests;

use App\Rules\NyscStateCode;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'phone_number' => ['required', 'string', 'max:16'],
            'deployed_state' => ['required', 'exists:states,state_code'],
            'nysc_call_up_number' => ['required', 'string', 'max:20', 'unique:profiles'],
            'email' => ['bail', 'sometimes', 'email:dns', 'unique:users,email'],
            'nysc_state_code' => ['bail', 'required', new NyscStateCode(), 'unique:profiles'],
            'photo' => ['sometimes', 'image', 'max:10000'],
            'device_id' => ['sometimes', 'uuid'],
        ];
    }
}
