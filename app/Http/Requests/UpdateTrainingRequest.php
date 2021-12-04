<?php

namespace App\Http\Requests;

use App\Enums\TrainingStatus;
use App\Models\Training;
use BenSampo\Enum\Rules\EnumValue;
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
    public function rules(): array
    {
        /** @var Training $training */
        $training = $this->route('training');
        if ($training === null) {
            throw new \LogicException('Training not returned from route');
        }

        return [
            'title' => ['sometimes', 'string', 'min:3'],
            'overview' => ['sometimes', 'string', 'min:5'],
            'start_time' => ['sometimes', 'date_format:Y-m-d H:i:s', 'after_or_equal:' . $training->start_time],
            'attendance_time' => ['sometimes', 'date_format:Y-m-d H:i:s', 'after:start_time'],
            'tutor' => ['sometimes', 'string'],
            'live_video' => ['sometimes', 'active_url'],
//            'resources.' => ['sometimes', 'array'],
//            'resources.*.attachment' => ['file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt', 'max:10000'],
            'status' => ['sometimes', new EnumValue(TrainingStatus::class, false)],
        ];
    }
}
