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
            return ["name" => $variant->color, "image" => $variant->color_image];
        });
        $sizes = $variants->map(function ($variant) {
            return ["name" => $variant->size, "image" => $variant->size_image];
        });
        $shop = $this->shop;
        $all_comments = $this->allComments;
        $shop_rating_count = 0;
        foreach ($shop->allProducts as $product) {
            $shop_rating_count += $product->evaluateComments()->count();
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "rating" => $this->rating,
            "sold" => $this->sold,
            "colors" => $colors->unique("name"),
            "sizes" => $sizes->unique("name"),
            "inventory" => $this->inventory,
            "is_variant" => $this->is_variant ? true : null,
            "images" => collect($this->images)->map(function ($image) {
                return ["url" => $image];
            }),
            "shop" => [
                "id" => $shop->id,
                "name" => $shop->name,
                "locate" => $shop->locate,
                "avatar" => $shop->avatar,
                "product_count" => $shop->allProducts->count(),
                "rating" => $shop->rating,
                "followers" => $shop->followers->count(),
                "rating_count" => $shop_rating_count,
            ],
            "category" => $this->category->name,
            "address" => $this->warehouse,
            "detail" => str_replace("\n", "<br/>", $this->detail),
            "comments" => [
                "num_page" => ceil($all_comments->count() / 6),
                "comments" => CommentResource::collection($this->comments(1)),
            ],
            "relate_products" => CompactProductResource::collection($this->relates()),
            "rating_count" => [
                "all" => $this->filterRating()->count(),
                "star_1" => $this->filterRating(1)->count(),
                "star_2" => $this->filterRating(2)->count(),
                "star_3" => $this->filterRating(3)->count(),
                "star_4" => $this->filterRating(4)->count(),
                "star_5" => $this->filterRating(5)->count(),
            ],
        ];
    }
}
