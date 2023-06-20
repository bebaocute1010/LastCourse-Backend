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
            "images" => "nullable|array|min:1|max:10",
            "shop_id" => "required|exists:shops,id",
            "cat_id" => "required|exists:categories,id",
            "condition_id" => "required|exists:product_conditions,id",
            "warehouse_id" => "required|exists:warehouses,id",
            "carrier_id" => "required|exists:carriers,id",
            "is_variant" => "nullable|boolean",
            "is_buy_more_discount" => "nullable|boolean",
            "is_pre_order" => "nullable|boolean",
            "name" => "required|string|max:255",
            "detail" => "required|string|max:1500",
            "brand" => "nullable|string|max:100",
            "price" => "required|integer",
            "promotional_price" => "nullable|integer",
            "weight" => "required|integer",
            "length" => "required|integer",
            "width" => "required|integer",
            "height" => "required|integer",
            "variant_names" => "requiredWith:is_variant|array|min:1|max:2",
            "variant_images" => "requiredWith:is_variant|array|min:1|max:2",
            "variants_item_quantity" => "requiredWith:is_variant|array|min:1",
            "variants_item_price" => "requiredWith:is_variant|array|min:1",
            "variant_images" => "requiredWith:is_variant|array|min:1",
            "discount_ranges_min" => "requiredWith:is_buy_more_discount|array|min:1|max:5",
            "discount_ranges_max" => "requiredWith:is_buy_more_discount|array|min:1|max:5",
            "discount_ranges_amount" => "requiredWith:is_buy_more_discount|array|min:1|max:5",
        ];
    }
}
