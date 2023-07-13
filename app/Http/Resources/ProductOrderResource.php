<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Truyền vào 1 Cart
        // dd($this);
        $product = $this->product;
        // dd($product);
        return [
            "image" => $product->firstImage->url,
            "name" => $product->name,
            "price" => $this->getPrice($product, $this->variant, $this->quantity),
            "quantity" => $this->quantity,
        ];
    }

    public function getPrice($product, $variant, $quantity)
    {
        $price = $product->promotional_price ?? $product->price;
        if ($variant != null) {
            $price = $variant->price;
        }
        if ($product->is_buy_more_discount) {
            $discount_ranges = $product->discountRanges;
            foreach ($discount_ranges as $discount) {
                if ($quantity >= $discount->min && $quantity < $discount->max) {
                    $price -= $discount->amount;
                    break;
                }
            }
        }
        return $price;
    }
}
