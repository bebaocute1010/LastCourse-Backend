<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCartRequest;
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

    public function updateOrCreate(CreateCartRequest $request)
    {
        $data_validated = $request->validated();
        if ($request->id) {
            if ($cart = $this->cart_service->update($request->id, $data_validated["quantity"])) {
                return $cart;
            }
        } else {
            if ($cart = $this->cart_service->create($data_validated)) {
                return $cart;
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            if ($cart = $this->cart_service->update($request->id, 0)) {
                return $cart;
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
