<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'min:3'],
            'overview' => ['sometimes', 'string', 'min:5'],
            'start_time' => ['sometimes', 'date_format:Y-m-d H:i:s'],
            'tutor' => ['sometimes', 'string'],
            'live_video' => ['sometimes', 'active_url'],
            'resources.' => ['sometimes', 'array'],
            'resources.*.attachment' => ['file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt', 'max:10000']
        ];
    }
}
