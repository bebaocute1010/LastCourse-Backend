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
        $allProducts = $shop->allProducts()->with("allComments")->get();
        foreach ($allProducts as $product) {
            $shop_rating_count += $product->allComments->count();
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "promotional_price" => $this->promotional_price,
            "rating" => $this->rating,
            "sold" => $this->sold,
            "colors" => $colors->unique("name")->toArray(),
            "sizes" => $sizes->unique("name")->toArray(),
            "inventory" => $this->inventory,
            "is_variant" => $this->is_variant ? true : null,
            "images" => collect($this->images)->map(function ($image) {
                return ["url" => $image];
            }),
            "shop" => [
                "name" => $shop->name,
                "slug" => $shop->slug,
                "locate" => $shop->locate,
                "avatar" => $shop->avatar,
                "product_count" => $shop->allProducts->count(),
                "rating" => $shop->rating,
                "followers" => $shop->followers->count(),
                "rating_count" => $shop_rating_count,
            ],
            "category" => $this->category->name,
            "address" => $shop->warehouse,
            "detail" => str_replace("\n", "<br/>", $this->detail),
            "comments" => [
                "num_page" => ceil($all_comments->count() / 6),
                "comments" => CommentResource::collection($this->comments(1)),
            ],
            "relate_products" => CompactProductResource::collection($this->relates()),
            "rating_count" => [
                $this->filterRating()->count(),
                $this->filterRating(1)->count(),
                $this->filterRating(2)->count(),
                $this->filterRating(3)->count(),
                $this->filterRating(4)->count(),
                $this->filterRating(5)->count(),
            ],
            "breadcrumb" => $this->breadcrumb,
        ];
    }
}
