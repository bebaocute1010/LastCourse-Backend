<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public const STATUS_OK = 0;
    public const STATUS_NOT_VERIFY = 1;
    public const STATUS_NOT_REGISTER_INFORMATION = 2;
    public const STATUS_NOT_EXIST = 3;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allProducts()
    {
        return $this->bills()->with('details.product')->get()->pluck('details')->flatten()->pluck('product');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class)->orderByDesc("created_at");
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)
            ->where("quantity", ">", 0)
            ->orderByDesc("created_at");
    }

    public function avatar()
    {
        return Image::find($this->avatar);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
