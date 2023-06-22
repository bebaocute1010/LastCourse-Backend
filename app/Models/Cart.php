<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        if ($this->product_variant_id) {
            return $this->belongsTo(ProductVariant::class);
        }
        return $this->belongsTo(Product::class);
    }
}
