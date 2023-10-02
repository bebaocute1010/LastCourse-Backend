<?php

namespace App\Http\Requests;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $date_begin = $this->input('date_begin');
        $discount_unit = $this->input('discount_unit');
        return [
            'name' => 'required|string|max:50',
            'code' => 'required|regex:/^[a-zA-Z0-9]*$/|max:12',
            'date_begin' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::now()->toDateString(),
            ],
            'date_end' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($date_begin) {
                    if (Carbon::parse($value)->greaterThanOrEqualTo(Carbon::parse($date_begin))) {
                        $fail('Ngày kết thúc không hợp lệ');
                    }
                }
            ],
            'discount_unit' => 'required|integer|min:0|max:1', // 0: %, 1: vnd
            'discount_level' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($discount_unit) {
                    if ($discount_unit == Voucher::DISCOUNT_UNIT_PERCENT && $value > 100) {
                        $fail('Mức giảm giá/Đơn vị không lớn hơn 100 phần trăm');
                    }
                }
            ],
            'quantity' => 'integer|min:1',
            'destination' => 'nullable|string|max:5500',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Thông tin không được để trống',
            'code.required' => 'Thông tin không được để trống',
            'date_begin.required' => 'Thông tin không được để trống',
            'date_end.required' => 'Thông tin không được để trống',
            'discount_unit.required' => 'Thông tin không được để trống',
            'discount_level.required' => 'Thông tin không được để trống',
            'name.max' => 'Độ dài tối đa 50 ký tự',
            'code.regex' => 'Mã giảm giá không hợp lệ',
            'code.max' => 'Độ dài tối đa 12 ký tự',
            'date_begin.date' => 'Ngày bắt đầu không hợp lệ',
            'date_begin.after_or_equal' => 'Ngày bắt đầu không hợp lệ',
            'date_end.date' => 'Ngày kết thúc không hợp lệ',
            'discount_unit.min' => 'Mức giảm giá/Đơn vị không hợp lệ',
            'discount_unit.max' => 'Mức giảm giá/Đơn vị không hợp lệ',
            'discount_level.integer' => 'Mức giảm giá/Đơn vị không hợp lệ',
            'discount_level.min' => 'Mức giảm giá/Đơn vị không hợp lệ',
            'destination.max' => 'Độ dài tối đa 5500 ký tự',
            'quantity.integer' => 'Số lượng mã không hợp lệ',
            'quantity.min' => 'Số lượng mã không hợp lệ'
        ];
    }
}
