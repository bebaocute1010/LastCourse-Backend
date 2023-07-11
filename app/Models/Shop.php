<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class);
    }

    public function banner()
    {
        return Image::find($this->banner);
    }

    public function avatar()
    {
        return Image::find($this->avatar);
    }

    public function allProducts()
    {
        return $this->hasMany(Product::class);
    }

    public function products($page = 1)
    {
        $per_page = 24;
        $offset = ($page - 1) * $per_page;

        return $this->hasMany(Product::class)
            ->skip($offset)
            ->take($per_page)->get();
    }

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class)->orderByDesc("created_at");
    }
}
