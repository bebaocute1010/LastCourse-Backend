<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopRequest;
use App\Models\Bill;
use App\Services\ShopService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shop_service;
    private $bill_ctl;

    public function __construct()
    {
        $this->shop_service = new ShopService();
        $this->bill_ctl = new BillController;
    }

    public function getBills()
    {
        return $this->bill_ctl->getBills(true);
    }

    public function updateOrCreate(CreateShopRequest $request)
    {
        $data_validated = $request->validated();
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
            $shop->products()->delete();
            $shop->followers()->delete();
            $shop->delete();
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::SHOP_DELETE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
