<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\CartService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    private $cart_service;

    public function __construct()
    {
        $this->cart_service = new CartService();
    }

    public function getProducts()
    {
        return CartResource::collection(auth()->user()->carts);
    }

    public function updateOrCreate(CreateCartRequest $request)
    {
        $data_validated = $request->validated();
        $data_validated["user_id"] = auth()->id();
        if ($request->id) {
            if ($this->cart_service->update($request->id, $data_validated["quantity"])) {
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::CART_UPDATE_PRODUCT_SUCCESS);
            }
        } else {
            if ($this->cart_service->create($data_validated)) {
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::CART_ADD_PRODUCT_SUCCESS);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            if ($this->cart_service->update($request->id, 0)) {
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::CART_DELETE_PRODUCT_SUCCESS);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
