<?php

namespace App\Http\Requests;

use App\Enums\TrainingStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class CreateTrainingRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'overview' => ['required', 'string', 'min:5'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'tutor' => ['required', 'string'],
            'live_video' => ['required', 'active_url'],
            'resources' => ['required', 'array'],
            'resources.*.attachment' => ['file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt', 'max:10000'],
            'status' => ['sometimes', new EnumValue(TrainingStatus::class)],
        ];
    }
}
