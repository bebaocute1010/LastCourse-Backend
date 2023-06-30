<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillRequest extends FormRequest
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
            "receiver" => "required|string|max:50",
            "phone" => "required|string|max:20",
            "address" => "required|string|max:500",
            "cart_ids" => "required|array",
            "cart_ids.*" => "required|numeric|exists:carts,id",
            "payment_method" => "required|numeric|in:0,1"
        ];
    }
}
