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
            "shop_id" => "required|numeric|exists:shops,id",
            "carrier_id" => "required|numeric|exists:carriers,id",
            "receiver" => "required|string|max:50",
            "phone" => "required|string|max:20",
            "address" => "required|string|max:500",
            "products" => "required|array",
            "products.*.id" => "required|numeric|exists:products,id",
            "products.*.variant_id" => "nullable|numeric|exists:product_variants,id",
            "products.*.price" => "required|numeric",
            "products.*.quantity" => "required|numeric"
        ];
    }
}
