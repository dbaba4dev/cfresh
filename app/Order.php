<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','employee_id','admin_id','user_email','name','address','pincode','mobile','shipping_charges','coupon_code',
        'coupon_amount','order_status','payment_method','grand_total','state','country','balance','amount_paid'];

    public function orders()
    {
        return $this->hasMany(OrdersProduct::class, 'order_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrderDetail($employee_id)
    {
        $getOrderDetail = Order::with('orders')->where('employee_id', $employee_id)->first();
        return $getOrderDetail;
    }
}
