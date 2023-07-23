<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            "title" => $this->data["title"],
            "message" => $this->data["message"],
            "code" => $this->data["code"],
            "type" => $this->data["type"],
            "read_at" => $this->read_at,
            "created_at" => $this->created_at,
        ];
    }
}
