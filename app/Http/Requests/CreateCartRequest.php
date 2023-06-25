<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Foundation\Http\FormRequest;

class CreateCartRequest extends FormRequest
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
        $variant_id = request("product_variant_id");
        $quantity_max = $variant_id ? ProductVariant::find($variant_id)->quantity : Product::find(request("product_id"))->quantity;
        return [
            "product_id" => "required|exists:products,id",
            "product_variant_id" => "nullable|exists:product_variants,id",
            "quantity" => ["required", "numeric", "min:0", "max:" . $quantity_max]
        ];
    }
}
