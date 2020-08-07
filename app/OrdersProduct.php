<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    protected $fillable = [
      'order_id',
      'product_id',
      'user_id',
      'product_name',
      'product_price',
      'product_qty',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
