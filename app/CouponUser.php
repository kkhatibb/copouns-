<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    public $timestamps = false;
    protected $primaryKey = false;

    protected $fillable = ['coupon_id' , 'user_id'];
}
