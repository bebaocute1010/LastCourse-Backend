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
            $this->deleteFile($image->url);
            $image->url = $data["url"];
            $image->save();
            return $this->image_repo->update(["url" => $data["url"]]);
        }
        return $this->image_repo->create($data);
    }

    public function delete($id)
    {
        $image = $this->image_repo->find($id);
        if ($image) {
            $this->deleteFile($image->url);
            $image->forceDelete();
        }
    }

    private function deleteFile($url)
    {
        $imagePath = public_path(parse_url($url, PHP_URL_PATH));
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }
}
