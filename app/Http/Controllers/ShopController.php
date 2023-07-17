<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShopRequest;
use App\Http\Resources\ProductInforResource;
use App\Http\Resources\ProductShopResource;
use App\Http\Resources\ShopInforResource;
use App\Http\Resources\ShopProfileResource;
use App\Services\CategoryService;
use App\Services\FollowerService;
use App\Services\ProductService;
use App\Services\ShopService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shop_service;
    private $category_service;
    private $bill_ctl;
    private $product_service;
    private $follower_service;

    public function __construct()
    {
        $this->shop_service = new ShopService();
        $this->category_service = new CategoryService();
        $this->product_service = new ProductService();
        $this->follower_service = new FollowerService();
        $this->bill_ctl = new BillController;
    }

    public function unFollow($shop_id)
    {
        if ($this->follower_service->unFollow($shop_id)) {
            return JsonResponse::successWithData([]);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function follow($shop_id)
    {
        if ($this->follower_service->follow($shop_id)) {
            return JsonResponse::successWithData([]);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function getShopProfile($id)
    {
        if ($shop = $this->shop_service->find($id)) {
            $shop->is_followed = $this->follower_service->checkFollowed($shop->id);
            return new ShopProfileResource($shop);
        }
    }

    public function getInforShop()
    {
        return new ShopInforResource(auth()->user()->shop);
    }

    public function getProduct(Request $request)
    {
        if ($product = $this->product_service->find($request->id)) {
            $category_family = $this->category_service->getCategoryFamily($product->category);
            $product->categories = $category_family["categories"];
            $product->categories_selected = $category_family["categories_selected"];
            if ($product->shop_id == auth()->user()->shop->id) {
                return new ProductInforResource($product);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function getProducts(Request $request)
    {
        $products = auth()->user()->shop->allProducts;
        if ($request->search) {
            return ProductShopResource::collection($this->shop_service->filterProducts($products, $request->search));
        }
        return ProductShopResource::collection($products);
    }

    public function getBills(Request $request)
    {
        return $this->bill_ctl->getBills($request, true);
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
                $shop->allProducts()->delete();
                $shop->followers()->delete();
                $shop->delete();
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::SHOP_DELETE_SUCCESS);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
