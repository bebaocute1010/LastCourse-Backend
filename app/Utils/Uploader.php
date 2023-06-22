<?php

namespace App\Utils;

use App\Http\Controllers\ImageController;
use App\Models\Image;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    private $image_ctl;

    public function __construct()
    {
        $this->image_ctl = new ImageController();
    }

    public function getDefaultAvatar()
    {
        return Image::DEFAULT_AVATAR_ID;
    }

    public function getImageIds(array $images)
    {
        $ids = [];
        foreach ($images as $image) {
            if (!$rs = $this->upload($image)) {
                continue;
            }
            $ids[] = $rs->id;
        }
        return $ids;
    }

    public function upload($image, $id = null)
    {
        $filename = $image->store(Image::DIR_PATH);
        $url = config("app.url") . Storage::url($filename);
        $data = [];
        if ($id) {
            $data = Arr::add($data, "id", $id);
        }
        $data = Arr::add($data, "url", $url);
        return $this->image_ctl->updateOrCreate($data);
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
