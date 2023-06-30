<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CompactProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchProductResource;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product_service;
    private $variant_keys;
    private $discount_keys;

    public function __construct()
    {
        $this->product_service = new ProductService();
        $this->variant_keys = [
            "variant_names",
            "variant_images",
            "variants_item_quantity",
            "variants_item_price",
        ];
        $this->discount_keys = [
            "discount_ranges_min",
            "discount_ranges_max",
            "discount_ranges_amount"
        ];
    }
    public function selectVariants(Request $request)
    {
        // if ($product = $this->product_service->find($request->id)) {
        //     return ProductVariant
        // }
    }

    public function getComments($slug, Request $request)
    {

        if ($product = $this->product_service->findBySlug($slug)) {
            return CommentResource::collection($product->comments($request->page));
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function searchProducts(Request $request)
    {
        return new SearchProductResource(
            $this->product_service->searchProducts(
                $request->search ?? "",
                $request->page ?? 1,
                $request->filter_cats ?? null,
                $request->filter_price_min ?? null,
                $request->filter_price_max ?? null,
                $request->filter_rating ?? null,
                $request->sort_newest ?? false,
                $request->sort_sell ?? false,
                $request->sort_desc_price ?? null,
            )
        );
    }

    public function getRecommendedProducts(Request $request)
    {
        return CompactProductResource::collection($this->product_service->getRecommendedProducts($request->page ?? 1));
    }

    public function getTopSellingProducts()
    {
        return CompactProductResource::collection($this->product_service->getTopSellingProducts());
    }

    public function getFeaturedProducts()
    {
        return CompactProductResource::collection($this->product_service->getFeaturedProducts());
    }

    public function getDetails($slug)
    {
        if ($slug) {
            if ($product = $this->product_service->getDetails($slug)) {
                return new ProductResource($product);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_BAD_REQUEST);
    }

    public function delete(Request $request)
    {
        if ($request->id && $this->product_service->delete($request->id)) {
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::PRODUCT_DELETE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function updateOrCreate(CreateProductRequest $request)
    {
        $data_validated = $request->validated();
        $shop = auth()->user()->shop;
        $data_validated = array_merge($data_validated, [
            "shop_id" => $shop->id,
            "warehouse_id" => $shop->warehouse->id,
            "slug" => $this->createSlug($data_validated["name"]),
        ]);
        if ($request->id) {
            $data_validated["id"] = $request->id;
        }
        if (!Arr::exists($data_validated, "is_variant")) {
            $data_validated = Arr::except($data_validated, $this->variant_keys);
        }
        if (!Arr::exists($data_validated, "is_buy_more_discount")) {
            $data_validated = Arr::except($data_validated, $this->discount_keys);
        }

        if ($this->product_service->updateOrCreate($data_validated, $this->variant_keys, $this->discount_keys)) {
            if ($request->id) {
                return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::PRODUCT_UPDATE_SUCCESS);
            }
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::PRODUCT_CREATE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    private function createSlug($name)
    {
        $slug = Str::slug($name . " " . Str::random(10), "-");
        if (Product::where("slug", $slug)->first()) {
            $this->createSlug($name);
        }
        return $slug;
    }
}
