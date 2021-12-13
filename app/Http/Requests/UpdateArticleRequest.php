<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
        return [
                'image' => ['sometimes', 'file', 'mimes:jpg,jpeg,png', 'max:10000'],
                'title' => ['required', 'string', 'min:3'],
                'content' => ['sometimes', 'string'],
                'category_id' => ['sometimes', 'exists:categories,id'],
                'state_code' => ['sometimes', 'exists:states,state_code'],
                'is_featured' => ['sometimes', 'boolean'],
        ];
    }
}
