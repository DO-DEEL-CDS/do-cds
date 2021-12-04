<?php

namespace App\Http\Requests;

use App\Enums\GMBStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGmbBusiness extends FormRequest
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
            'business_email' => ['sometimes', 'email:dns'],
            'business_name' => ['sometimes', 'string', 'min:3', 'unique:gmb_submissions'],
            'business_owner' => ['sometimes', 'string', 'min:3'],
            'owner_gender' => ['sometimes', 'string', 'in:,male,female'],
            'status' => ['sometimes', new EnumValue(GMBStatus::class)]
        ];
    }
}
