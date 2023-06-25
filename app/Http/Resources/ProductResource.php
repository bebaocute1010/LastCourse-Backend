<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $variants = $this->variants;
        $colors = $variants->map(function ($variant) {
            return ["color" => $variant->color, "image" => $variant->colorImage->url ?? null];
        });
        $sizes = $variants->map(function ($variant) {
            return ["size" => $variant->size, "image" => $variant->sizeImage->url ?? null];
        });
        return [
            "name" => $this->name,
            "rating" => $this->rating,
            "sold" => $this->sold,
            "colors" => $colors,
            "size" => $sizes,
            "inventory" => $this->inventory,
            "images" => $this->images()->pluck("url"),
            "shop" => [
                "name" => $this->shop->name,
                "avatar" => $this->shop->avatar()->url,
                "product_count" => $this->shop->products->count(),
                "rating" => $this->shop->rating,
                "followers" => $this->shop->followers->count(),
            ],
            "category" => $this->category->name,
            "address" => $this->warehouse->address,
            "detail" => $this->detail,
            "comments" => CommentResource::collection($this->comments(1)),
            "relate_products" => CompactProductResource::collection($this->relates()),
        ];
    }
}
