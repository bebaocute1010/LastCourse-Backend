<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function findUrl($url)
    {
        return Image::where("url", $url)->first();
    }

    public function find($id)
    {
        return Image::find($id);
    }

    public function create(array $data)
    {
        return Image::create($data);
    }

    public function update(array $data)
    {
        $image = Image::find($data["id"]);
        $image->update(["url" => $data["url"]]);
        return $image;
    }
}
