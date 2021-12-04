<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGmbBusiness extends FormRequest
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
            'business_email' => ['required', 'email:dns'],
            'business_name' => ['required', 'string', 'min:3', 'unique:gmb_submissions'],
            'business_owner' => ['required', 'string', 'min:3'],
            'owner_gender' => ['required', 'string', 'in:,male,female'],
        ];
    }
}
