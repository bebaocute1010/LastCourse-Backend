<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            "images" => "nullable|array|min:1|max:10",
            "cat_id" => "required|exists:categories,id",
            "condition_id" => "required|exists:product_conditions,id",
            "is_variant" => "nullable|boolean",
            "is_buy_more_discount" => "nullable|boolean",
            "is_pre_order" => "nullable|boolean",
            "name" => "required|string|max:255",
            "detail" => "required|string|max:1500",
            "brand" => "nullable|string|max:100",
            "price" => "required|numeric",
            "promotional_price" => "nullable|numeric",
            "inventory" => "nullable|numeric|min:0",
            "weight" => "required|numeric",
            "length" => "required|numeric",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "variant_names" => "nullable|array|min:1|max:2",
            "variant_images" => "nullable|array|min:1|max:2",
            "variants_item_quantity" => "nullable|array|min:1",
            "variants_item_price" => "nullable|array|min:1",
            "discount_ranges_min" => "nullable|array|min:1|max:5",
            "discount_ranges_max" => "nullable|array|min:1|max:5",
            "discount_ranges_amount" => "nullable|array|min:1|max:5",
        ];
    }
}
