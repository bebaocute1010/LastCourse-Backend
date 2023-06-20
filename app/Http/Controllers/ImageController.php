<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $image_service;

    public function __construct()
    {
        $this->image_service = new ImageService();
    }

    public function updateOrCreate(array $data)
    {
        return $this->image_service->updateOrCreate($data);
    }
}
