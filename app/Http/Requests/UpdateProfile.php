<?php

namespace App\Http\Requests;

use App\Rules\NyscStateCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'name' => ['sometimes', 'string', 'min:3'],
            'email' => ['sometimes', 'email:dns'],
            'phone' => ['sometimes', 'string', 'max:15'],
            'deployed_state' => ['sometimes', 'exists:states,state_code'],
            'nysc_call_up_number' => ['sometimes', 'string', 'filled'],
            'nysc_state_code' => ['sometimes', new NyscStateCode()],
            'device_id' => ['sometimes', 'string'],
            'photo' => ['sometimes', 'image', 'max:10000']
        ];
    }


}
