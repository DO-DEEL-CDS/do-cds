<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createArticleRequest extends FormRequest
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
            'image' => ['required', 'image', 'max:10000'],
            'title' => ['required', 'string', 'min:3'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'state_code' => ['sometimes', 'exists:states,state_code'],
            'is_featured' => ['required', 'boolean'],
        ];
    }
}
