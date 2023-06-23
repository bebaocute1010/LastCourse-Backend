<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "product_id" => "required|exists:products,id",
            "comment_id" => "nullable|exists:comments,id",
            "content" => "nullable|string|max:1000",
            "rating" => "required|integer|min:1|max:5",
            "images" => "nullable|array",
        ];
    }
}
