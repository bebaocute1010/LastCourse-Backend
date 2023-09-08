<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $variant = $this->variant;
        $product = $this->product;
        return [
            "id" => $this->id,
            "name" => $product->name,
            "variant" => $variant ? $this->getVariantString($variant) : null,
            "price" => $variant ? $variant->price : $product->price,
            "quantity" => $this->quantity,
            "image" => $product->images[0] ?? null,
            "slug" => $product->slug,
        ];
    }
    private function getVariantString($variant)
    {
        if ($variant->color && $variant->size) {
            return $variant->color . ", " . $variant->size;
        }
        return $variant->color ?? $variant->size;
    }
}
