<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['box_id','product_name','price','quantity','user_email','session_id'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
