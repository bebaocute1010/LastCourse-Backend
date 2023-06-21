<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopRequest;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shop_service;

    public function __construct()
    {
        $this->shop_service = new ShopService();
    }

    public function updateOrCreate(CreateShopRequest $request)
    {
        $data_validated = $request->validated();
        if ($request->id) {
            return $this->shop_service->update($request->id, $data_validated);
        }
        return $this->shop_service->create($data_validated);
    }
}
