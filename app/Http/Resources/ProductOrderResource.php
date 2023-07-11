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
            "price" => $this->product_variant_id === null ? $product->price : $this->variant->price,
            "quantity" => $this->quantity
        ];
    }
}
