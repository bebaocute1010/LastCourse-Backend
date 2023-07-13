<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopInforResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $warehouse = $this->warehouse;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "avatar" => $this->avatar()->url,
            "banner" => $this->banner()->url,
            "locate" => $this->locate,
            "carrier_id" => $this->carrier_id,
            "warehouse" => [
                "name" => $warehouse->name,
                "address" => $warehouse->address,
            ],
        ];
    }
}
