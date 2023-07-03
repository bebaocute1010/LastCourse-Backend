<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function comment()
    {
        return Comment::where("bill_id", $this->bill->id)->where("product_id", $this->product->id)->first();
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, "product_variant_id");
    }
}
