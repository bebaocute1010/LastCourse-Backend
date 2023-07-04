<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const STATUS_HIDDEN = "Đã ẩn";
    public const STATUS_AVAILABLE = "Còn hàng";
    public const STATUS_UNAVAILABLE = "Hết hàng";

    public function filterVariants($color = null, $size = null)
    {
        return $this->variants()
            ->when($color, function ($query) use ($color) {
                return $query->where("color", $color);
            })
            ->when($size, function ($query) use ($size) {
                return $query->where("size", $size);
            })
            ->get();
    }

    public function filterRating($rating = null)
    {
        return $this->hasMany(Comment::class)
            ->when($rating !== null, function ($query) use ($rating) {
                $query->where("rating", $rating);
            })
            ->get();
    }

    public function condition()
    {
        return $this->belongsTo(ProductCondition::class);
    }

    public function getShippingFee()
    {
        // Cong thuc tinh gia ship
        return 0.003 * $this->weight + 0.0000001 * $this->length * $this->width * $this->height;
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function relates()
    {
        return Product::whereIn("cat_id", [$this->cat_id, $this->category->parent_id])
            ->orderBy("sold", "desc")
            ->whereNot("id", $this->id)
            ->take(12)->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "cat_id");
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function firstImage()
    {
        return $this->belongsTo(Image::class, "image_ids");
    }

    public function images()
    {
        return Image::whereIn("id", $this->image_ids)->get();
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductVariant::class)
            ->select("color")
            ->distinct()
            ->pluck("color")
            ->toArray();
    }

    public function sizes()
    {
        return $this->hasMany(ProductVariant::class)
            ->select("size")
            ->distinct()
            ->pluck("size")
            ->toArray();
    }

    public function comments($page = null)
    {
        $per_page = 6;
        $offset = ($page - 1) * $per_page;

        return $this->hasMany(Comment::class)
            ->with("replies")
            ->whereNull("comment_id")
            ->orderBy("created_at", "desc")
            ->skip($offset)
            ->take($per_page)->get();
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getAverageRating()
    {
        $evaluates = $this->evaluateComments();
        return round($this->getTotalRating() / $evaluates->count(), 1);
    }

    public function getTotalRating()
    {
        return $this->evaluateComments()->sum("rating");
    }

    public function evaluateComments()
    {
        return $this->allComments->filter(function ($comment) {
            return $comment->comment_id === null;
        });
    }

    public function discountRanges()
    {
        return $this->hasMany(DiscountRange::class);
    }

    public function setImageIdsAttribute($value)
    {
        $this->attributes["image_ids"] = json_encode($value);
    }

    public function getImageIdsAttribute($value)
    {
        return json_decode($value);
    }
}
