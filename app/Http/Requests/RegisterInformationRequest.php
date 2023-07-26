<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterInformationRequest extends FormRequest
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
            "email" => "required|email|exists:users,email",
            "username" => "required|string|min:8|max:20",
            "password" => "required|string|min:8|max:20|confirmed",
            "fullname" => "required|string|max:255",
            "avatar" => "nullable|string|max:500",
            "birthday" => "required|date",
            "gender" => "required|numeric",
            "introduced_code" => "nullable|string",
        ];
    }
}
