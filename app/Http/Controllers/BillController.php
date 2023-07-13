<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBillRequest;
use App\Http\Resources\BillDetailResource;
use App\Http\Resources\BillResource;
use App\Services\BillService;
use App\Utils\MessageResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class BillController extends Controller
{
    private $bill_service;

    public function __construct()
    {
        $this->bill_service = new BillService();
    }

    public function getBillDetails(Request $request)
    {
        if ($bill = $this->bill_service->find($request->id)) {
            if ($bill->user_id == auth()->id() || $bill->shop_id == auth()->user()->shop->id) {
                return BillDetailResource::collection($bill->details);
            }
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function getBills(Request $request, $is_shop = null)
    {
        if (!$is_shop) {
            $bills = auth()->user()->bills;
        } else {
            $bills = auth()->user()->shop->bills;
        }
        if ($search_string = $request->search) {
            return BillResource::collection($this->bill_service->getFilterBill($bills, $search_string));
        }
        return BillResource::collection($bills);
    }

    public function updateOrCreate(CreateBillRequest $request)
    {
        $data_validated = $request->validated();
        return $this->bill_service->updateOrCreate($data_validated, $request->id);
    }

    public function updateStatus(Request $request, Route $route)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                if (str_ends_with($route->uri, "confirm")) {
                    $status = 1;
                } else if (str_ends_with($route->uri, "delivery")) {
                    $status = 2;
                } else if (str_ends_with($route->uri, "success")) {
                    $status = 3;
                } else if (str_ends_with($route->uri, "return")) {
                    $status = 4;
                } else if (str_ends_with($route->uri, "cancel")) {
                    $status = 5;
                } else {
                    $status = -1;
                }
                if (!$this->bill_service->updateStatus($id, $status)) {
                    return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
                }
            }
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::BILL_UPDATE_STATUS_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }
}
