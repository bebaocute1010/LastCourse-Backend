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
            "variant" => $variant ? [
                "color" => $variant->color,
                "size" => $variant->size,
            ] : null,
            "price" => $variant ? $variant->price : $product->price,
            "quantity" => $this->quantity,
            "image" => $product->firstImage->url ?? "#",
        ];
    }
}
