<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompactProductResource extends JsonResource
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
            "slug" => $this->slug,
            "name" => $this->name,
            "image" => $this->images[0] ?? null,
            "price" => $this->price,
            "sold" => $this->sold,
            "rating" => round($this->rating, 1),
        ];
    }
}
