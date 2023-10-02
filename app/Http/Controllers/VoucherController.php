<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function store(CreateVoucherRequest $request)
    {
        $data = $request->validated();
        $voucher = Voucher::create($data);
        if ($voucher) {
            return response("Tạo mã giảm giá thành công");
        }
        return response("Lôi hệ thống", 500);
    }
}
