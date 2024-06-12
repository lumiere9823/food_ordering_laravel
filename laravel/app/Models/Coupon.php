<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Coupon extends Model
{
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $fillable = [
        'coupon_code',
        'coupon_number',
        'coupon_type',
        'coupon_value',
        'cart_min_value',
        'coupon_status',
        'expire_on',
        'added_on',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($coupon) {
            $coupon->coupon_code = self::generateUniqueCouponCode();
        });
    }

    private static function generateUniqueCouponCode()
    {
        do {
            $code = Str::random(8);
        } while (self::where('coupon_code', $code)->exists());

        return $code;
    }
}