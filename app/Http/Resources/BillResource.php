<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "image" => $this->details->first()->product->images[0] ?? null,
            "receiver" => $this->receiver,
            "phone" => $this->phone,
            "address" => $this->address,
            "created_at" => $this->created_at,
            "status" => $this->status,
            "shipping_fee" => $this->shipping_fee,
            "total" => $this->total,
        ];
    }
}
