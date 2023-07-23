<?php

namespace App\Http\Resources;

use App\Models\Bill;
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
            "id" => $this->id,
            "name" => $this->product->name,
            "image" => $this->product->images[0],
            "price" => $this->price,
            "variant" => $variant ? $this->getVariantString($variant) : "-",
            "quantity" => $this->quantity,
            "cost" => $this->price * $this->quantity,
            "have_evaluated" => $this->bill->status != Bill::STATUS_SUCCESS ? false : ($this->comment() ? true : null),
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
