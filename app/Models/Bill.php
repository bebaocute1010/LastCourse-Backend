<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const STATUS_SUCCESS = 3;

    public function products()
    {
        return $this->hasManyThrough(Product::class, BillDetail::class);
    }

    public function details()
    {
        return $this->hasMany(BillDetail::class);
    }
}
