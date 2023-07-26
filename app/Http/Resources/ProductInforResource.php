<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductInforResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->loadMissing("variants");
        $category = $this->category;
        $parent = $category->parent;
        $variants = $this->variants;

        $colors = $variants->unique("color")->map(function ($variant) {
            return [
                "image" => $variant->color_image,
                "color" => $variant->color,
            ];
        })->values();
        $sizes = $variants->unique("size")->map(function ($variant) {
            return [
                "image" => $variant->size_image,
                "size" => $variant->size,
            ];
        })->values();

        $column_group = ($colors->pluck("color")->count() <= 1 && isset($colors->pluck("color")[0]) && $colors->pluck("color")[0] == null) ? "size" : "color";

        $groupedQuantities = $variants->groupBy($column_group)->map(function ($variants, $color) use ($column_group, $sizes) {
            $prices = $variants->pluck("price")->toArray();
            $quantities = $variants->pluck("quantity")->toArray();
            return [
                "prices" => $prices,
                "quantities" => $quantities,
            ];
        });

        $prices = $groupedQuantities->pluck("prices")->toArray();
        $quantities = $groupedQuantities->pluck("quantities")->toArray();

        if ($column_group == "color" && $sizes->pluck("size")->count() <= 1 && (!isset($colors->pluck("size")[0]) || $sizes->pluck("size")[0] == null)) {
            $prices = [array_merge_recursive(...$prices), [null]];
            $quantities = [array_merge_recursive(...$quantities), [null]];
        } else if ($column_group == "size" && $colors->pluck("color")->count() <= 1 && (!isset($colors->pluck("color")[0]) && $colors->pluck("color")[0] == null)) {
            $prices = [[null], array_merge_recursive(...$prices)];
            $quantities = [[null], array_merge_recursive(...$quantities)];
        }
        $discount_ranges = $this->discountRanges;
        return [
            "categories" => $this->categories,
            "categories_selected" => $this->categories_selected,
            "images" => $this->images,
            "cat_id" => $this->cat_id,
            "condition_id" => $this->condition->id,
            "is_variant" => $this->is_variant ? true : false,
            "is_buy_more_discount" => $this->is_buy_more_discount ? true : false,
            "is_pre_order" => $this->is_pre_order ? true : false,
            "name" => $this->name,
            "detail" => $this->detail,
            "brand" => $this->brand,
            "inventory" => $this->inventory,
            "price" => $this->price,
            "promotional_price" => $this->promotional_price,
            "weight" => $this->weight,
            "length" => $this->length,
            "height" => $this->height,
            "width" => $this->width,
            "variant_names" => [$colors->pluck("color"), $sizes->pluck("size")],
            "variant_images" => [$colors->pluck("image"), $sizes->pluck("image")],
            "variants_item_quantity" => $quantities,
            "variants_item_price" => $prices,
            "discount_ranges_min" => $discount_ranges->pluck("min"),
            "discount_ranges_max" => $discount_ranges->pluck("max"),
            "discount_ranges_amount" => $discount_ranges->pluck("amount"),
        ];
    }
}
