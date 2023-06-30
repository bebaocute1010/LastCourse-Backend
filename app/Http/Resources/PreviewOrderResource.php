<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PreviewOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shop = $this["shop"];
        $delay = random_int(2, 5);
        info($shop);
        return [
            "shop_name" => $shop->name,
            "warehouse" => $shop->warehouse->address,
            "shop_avatar" => $shop->avatar()->url,
            "shipping_fee" => $this["shipping_fee"],
            "shipping_carrier" => $shop->carrier->name,
            "delivery_time" => PreviewOrderResource::formatDate(Carbon::now()->addDays($delay))
                . "-"
                . PreviewOrderResource::formatDate(Carbon::now()->addDays($delay + 2)),
            "cart_ids" => $this["carts"]->pluck("id"),
            "products" => ProductOrderResource::collection($this["carts"]),

        ];
    }

    private function formatDate($date): string
    {
        $day = ltrim($date->format("d"), "0");
        $month = ltrim($date->format("m"), "0");
        return $day . "Th" . $month;
    }
}
