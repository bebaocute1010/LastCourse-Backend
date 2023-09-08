<?php

namespace App\Utils;

use App\Http\Controllers\ImageController;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    private $image_ctl;

    public function __construct()
    {
        $this->image_ctl = new ImageController();
    }

    public function getIdImage($url = null)
    {
        return $this->image_ctl->findUrl($url)->id ?? null;
    }

    public function getDefaultAvatar()
    {
        return Image::DEFAULT_AVATAR_ID;
    }

    public function getImagesUrl(array $images)
    {
        $images_url = [];
        foreach ($images as $image) {
            if (!$rs = $this->upload($image)) {
                continue;
            }
            $images_url[] = $rs;
        }
        return $images_url;
    }

    public function upload($image)
    {
        if (gettype($image) == "string") {
            return $image;
        }
        $filename = $image->store(Image::DIR_PATH);
        $url = config("app.url") . Storage::url($filename);
        return $url;
    }

    public function delete($id)
    {
        $this->image_ctl->delete($id);
    }

    public function deleteImages(array $ids)
    {
        foreach ($ids as $id) {
            $this->delete($id);
        }
    }
}
