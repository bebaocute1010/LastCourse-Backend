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

    public function avatar()
    {
        return Image::find($this->avatar);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
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
