<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            "code" => "required|regex:/^[a-zA-Z0-9]*$/|max:12",
            "name" => "required|string|max:50",
            "image" => "mimes:jpg,png,webp|max:2048",
            "note" => "nullable|string|max:5000"
        ];
    }

    public function messages()
    {
        return [
            "image.mimes" => "Hình ảnh không hợp lệ",
            "image.max" => "Kích thước ảnh quá lớn",
            "code.required" => "Bạn chưa nhập mã danh mục",
            "code.regex" => "Mã danh mục không hợp lệ",
            "code.max" => "Độ dài tối đa 12 ký tự",
            "name.required" => "Bạn chưa nhập tên danh mục",
            "name.max" => "Độ dài tối đa 50 ký tự",
            "note.max" => "Độ dài tối đa 5000 ký tự"
        ];
    }
}
