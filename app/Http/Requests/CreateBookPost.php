<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'is_publishing' => 'sometimes|required|boolean',
            'is_commentable' => 'sometimes|required|boolean',
            'tags' => 'required|array',
            'tags.*' => 'required|string',
            'anchors' => 'required|array',
            'anchors.*.url' => 'required|url',
            'anchors.*.name' => 'required|string'
        ];
    }
}
