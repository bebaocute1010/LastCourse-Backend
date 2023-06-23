<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillDetailResource extends JsonResource
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
        return [
            "name" => $this->product->name,
            "price" => $this->price,
            "variant" => $variant ? [
                "color" => $variant->color,
                "size" => $variant->size,
            ] : null,
            "quantity" => $this->quantity,
        ];
    }
}
