<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
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
        return Image::where("id", $data["id"])->update(["url" => $data["url"]]);
    }
}
