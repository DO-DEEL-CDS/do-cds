<?php

namespace App\Http\Requests;

use App\Enums\Batch;
use App\Enums\ProjectStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'min:3'],
            'status' => ['sometimes', new EnumValue(ProjectStatus::class)],
            'overview' => ['sometimes', 'string'],
            'guide' => ['sometimes', 'nullable', 'string'],
            'batch' => ['sometimes', new EnumValue(Batch::class)],
            'year' => ['sometimes', 'date_format:Y'],
        ];
    }
}
