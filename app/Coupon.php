<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_code','amount','amount_type','expire_date','status'];
}
