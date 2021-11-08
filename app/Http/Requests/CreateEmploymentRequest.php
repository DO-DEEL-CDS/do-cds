<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmploymentRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:191'],
            'description' => ['required', 'string'],
            'role' => ['required', 'string', 'max:191'],
            'closing_date' => ['required', 'date'],
            'location' => ['sometimes', 'string', 'max:191'],
            'apply_link' => ['required', 'active_url', 'max:191'],
            'rate' => ['required', 'string', 'max:191'],
            'perks' => ['sometimes', 'array'],
            'perks.*' => ['string', 'max:191'],
            'employer_name' => ['required', 'string', 'max:191'],
            'employer_location' => ['sometimes', 'string', 'max:191'],
            'employer_logo' => ['image', 'max:50000'],
            'employer_email' => ['sometimes', 'email', 'max:191'],
        ];
    }
}
