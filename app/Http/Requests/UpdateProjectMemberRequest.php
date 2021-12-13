<?php

namespace App\Http\Requests;

use App\Enums\Batch;
use App\Enums\ProjectMemberType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
        return [
                'year' => ['sometimes', 'date_format:Y'],
                'batch' => ['sometimes', new EnumValue(Batch::class)],
                'name' => ['sometimes', 'string'],
                'email' => ['sometimes', 'email'],
                'position' => ['sometimes', 'string'],
                'facebook_link' => ['sometimes', 'active_url'],
                'state_code' => ['sometimes', 'exists:states'],
                'phone_number' => ['sometimes', 'max:16'],
                'instagram' => ['sometimes', 'string'],
                'type' => ['sometimes', new EnumValue(ProjectMemberType::class)],
        ];
    }
}
