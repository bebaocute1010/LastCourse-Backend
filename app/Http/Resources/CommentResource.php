<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->user;
        return [
            "id" => $this->id,
            "user" => [
                "name" => $user->fullname,
                "avatar" => $user->avatar()->url,
            ],
            "content" => $this->content,
            "images" => $this->getImages()->pluck("url"),
            "rating" => $this->rating,
            "replies" => CommentResource::collection($this->replies),
        ];
    }
}
