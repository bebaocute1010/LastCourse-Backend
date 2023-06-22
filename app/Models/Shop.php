<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getAverageRating()
    {
        $totalRating = 0;
        $ratingCount = 0;
        $products = $this->products;
        foreach ($products as $product) {
            $totalRating += $product->getTotalRating();
            $ratingCount += $product->evaluateComments()->count();
        }
        return round($totalRating / $ratingCount, 1);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
