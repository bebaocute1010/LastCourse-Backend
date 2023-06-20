<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ImageService
{
    private $image_repo;

    public function __construct()
    {
        $this->image_repo = new ImageRepository();
    }

    public function updateOrCreate(array $data)
    {
        if (Arr::exists($data, "id")) {
            $image = $this->image_repo->find($data["id"]);
            $imagePath = public_path(parse_url($image->url, PHP_URL_PATH));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $image->url = $data["url"];
            $image->save();
            return $this->image_repo->update(["url" => $data["url"]]);
        }
        return $this->image_repo->create($data);
    }
}
