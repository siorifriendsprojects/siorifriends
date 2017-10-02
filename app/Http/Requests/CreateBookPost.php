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
            "book.title" => "string",
            "book.description" => "string",
            "book.is_publishing" => "sometimes|boolean",
            "book.is_commentable" => "sometimes|boolean",
            "book.tags" => "string",
            "book.anchors" => "string",
            "book.anchors.*.url" => "url",
            "book.anchors.*.name" => "string"
        ];
    }
}
