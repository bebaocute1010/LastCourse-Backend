<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function colorImage()
    {
        return $this->belongsTo(Image::class, "color_image_id");
    }

    public function sizeImage()
    {
        return $this->belongsTo(Image::class, "size_image_id");
    }
}
