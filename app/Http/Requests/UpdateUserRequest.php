<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use App\Rules\NyscStateCode;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    public function rules()
    {
        $userId = $this->route()->parameter('user')->id;
        return [
            'name' => ['sometimes', 'string', 'min:3'],
            'email' => ['sometimes', 'email:dns', Rule::unique('users')->ignore($userId)],
            'phone' => ['sometimes', 'string', 'max:15'],
            'deployed_state' => ['sometimes', 'exists:states,state_code'],
            'nysc_call_up_number' => ['sometimes', 'string', Rule::unique('profiles')->ignore($userId, 'user_id')],
            'nysc_state_code' => ['sometimes', new NyscStateCode(), Rule::unique('profiles')->ignore($userId, 'user_id')],
            'device_id' => ['sometimes', 'string'],
            'photo' => ['sometimes', 'image', 'max:10000'],
            'status' => ['sometimes', new EnumValue(UserStatus::class)]
        ];
    }
}
