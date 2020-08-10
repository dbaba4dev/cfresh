<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Coupon extends Model
{
    protected $fillable = ['coupon_code','amount','amount_type','expire_date','status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
