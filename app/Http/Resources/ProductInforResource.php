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
        $category = $this->category;
        $parent = $category->parent;
        return [
            "images" => $this->images()->pluck("url"),
            "cat_lv1" => $parent ? $parent->name : $category->name,
            "cat_lv2" => $parent ? $category->name : null,
            "name" => $this->name,
            "detail" => $this->detail,
            "brand" => $this->brand,
            "warehouse" => $this->warehouse->name,
            "price" => $this->price,
            "promotional_price" => $this->promotional_price,
            "shipping_fee" => $this->getShippingFee(),
            "condition" => $this->condition->name,
            "is_pre_order" => $this->is_pre_order,
            "buy_more_discount" => DiscountRangeResource::collection($this->discountRanges),
            "weight" => $this->weight,
            "length" => $this->length,
            "height" => $this->height,
            "width" => $this->width,
            "colors" => $this->colors(),
            "sizes" => $this->sizes(),
            "variants" => ProductVariantResource::collection($this->variants),
        ];
    }
}
