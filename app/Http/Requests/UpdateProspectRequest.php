<?php

namespace App\Http\Requests;

use App\Rules\NyscStateCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProspectRequest extends FormRequest
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
        $prospect = $this->route()->parameter('prospect');
        return [
                'name' => ['bail', 'sometimes', 'string', 'min:3'],
                'email' => ['bail', 'sometimes', 'email:dns', Rule::unique('prospects')->ignoreModel($prospect)],
                'deployed_state' => ['bail', 'sometimes', 'exists:states,state_code'],
                'nysc_state_code' => ['bail', 'sometimes', new NyscStateCode(), Rule::unique('prospects')->ignoreModel($prospect)],
                'intro_video' => ['sometimes', 'string', 'active_url']
        ];
    }

}
