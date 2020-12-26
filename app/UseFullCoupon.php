<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UseFullCoupon extends Model
{
    protected $fillable = ['user_id' , 'coupon_id'];
}
