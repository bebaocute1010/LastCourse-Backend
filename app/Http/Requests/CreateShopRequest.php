<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShopRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "carrier_id" => "required|string|exists:carriers,id",
            "name" => "required|string|max:50",
            "email" => "required|email|max:255",
            "locate" => "required|string|max:255",
            "avatar" => "required",
            "banner" => "required",
            "warehouse" => "required|array",
            "warehouse.*" => "required|string",
        ];
    }
}
