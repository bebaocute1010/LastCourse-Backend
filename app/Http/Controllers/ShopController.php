<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopRequest;
use App\Http\Resources\ProductInforResource;
use App\Http\Resources\ProductShopResource;
use App\Models\Bill;
use App\Services\ProductService;
use App\Services\ShopService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shop_service;
    private $bill_ctl;
    private $product_service;

    public function __construct()
    {
        $this->shop_service = new ShopService();
        $this->product_service = new ProductService();
        $this->bill_ctl = new BillController;
    }

    public function getProduct(Request $request)
    {
        if ($product = $this->product_service->find($request->id)) {
            if ($product->shop_id == auth()->user()->shop->id) {
                return new ProductInforResource($product);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function getProducts()
    {
        return ProductShopResource::collection(auth()->user()->shop->products);
    }

    public function getBills()
    {
        return $this->bill_ctl->getBills(true);
    }

    public function updateOrCreate(CreateShopRequest $request)
    {
        $data_validated = $request->validated();
        $data_validated["user_id"] = auth()->id();
        if ($request->id) {
            if ($this->shop_service->update($request->id, $data_validated)) {
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::SHOP_UPDATE_SUCCESS);
            }
            return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
        }
        if ($this->shop_service->create($data_validated)) {
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::SHOP_CREATE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function delete(Request $request)
    {
        if ($shop = $this->shop_service->find($request->id)) {
            if ($shop->user_id == auth()->id()) {
                $shop->products()->delete();
                $shop->followers()->delete();
                $shop->delete();
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::SHOP_DELETE_SUCCESS);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
