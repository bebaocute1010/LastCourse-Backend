<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\PreviewOrderRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\PreviewOrderResource;
use App\Services\CartService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart_service;

    public function __construct()
    {
        $this->cart_service = new CartService();
    }

    public function previewOrder(PreviewOrderRequest $request)
    {
        $data_validated = $request->validated();
        return PreviewOrderResource::collection($this->cart_service->getProductsSelected($data_validated["selected"]));
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
            if ($cart = $this->cart_service->update($request->id, $request["quantity"])) {
                return response()->json([
                    "title" => MessageResource::DEFAULT_SUCCESS_TITLE,
                    "message" => MessageResource::CART_UPDATE_PRODUCT_SUCCESS,
                    "id" => $cart->id,
                ]);
            }
        } else {
            if ($cart = $this->cart_service->create($data_validated)) {
                return response()->json([
                    "title" => MessageResource::DEFAULT_SUCCESS_TITLE,
                    "message" => MessageResource::CART_ADD_PRODUCT_SUCCESS,
                    "id" => $cart->id,
                ]);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function delete(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                if (!$this->cart_service->update($id, 0)) {
                    continue;
                }
            }
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::CART_DELETE_PRODUCT_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
