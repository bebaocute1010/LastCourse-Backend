<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products_count = $this->allProducts->count();
        return [
            "name" => $this->name,
            "avatar" => $this->avatar()->url,
            "banner" => $this->banner()->url,
            "followers" => $this->followers->count(),
            "rating" => $this->rating,
            "products_count" => $products_count,
            "num_page" => ceil($products_count / 24),
            "products" => CompactProductResource::collection($this->products()),
        ];
    }
}
