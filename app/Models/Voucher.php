<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const DISCOUNT_UNIT_PERCENT = 0;
    public const DISCOUNT_UNIT_VND = 1;
}
