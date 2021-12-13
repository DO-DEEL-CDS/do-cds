<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmploymentRequest extends FormRequest
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
                'title' => ['sometimes', 'string', 'max:191'],
                'description' => ['sometimes', 'string'],
                'role' => ['sometimes', 'string', 'max:191'],
                'closing_date' => ['sometimes', 'date'],
                'location' => ['sometimes', 'string', 'max:191'],
                'apply_link' => ['sometimes', 'active_url', 'max:191'],
                'rate' => ['sometimes', 'string', 'max:191'],
                'perks' => ['sometimes', 'array'],
                'perks.*' => ['string', 'max:191'],
                'employer_name' => ['sometimes', 'string', 'max:191'],
                'employer_location' => ['sometimes', 'string', 'max:191'],
                'employer_logo' => ['sometimes', 'file', 'mimes:jpg,jpeg,png', 'max:10000'],
                'employer_email' => ['sometimes', 'email', 'max:191'],
        ];
    }
}
