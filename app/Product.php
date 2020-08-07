<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    protected $fillable =['box_id','no_cases','comment'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public static function cartCount()
    {
        if (Auth::check())
        {
            // 'User is Logged in, we will use Auth';
            $user_email = Auth::user()->email;
            $cartCount = DB::table('carts')->where('user_email', $user_email)->sum('quantity');

        }else
        {
            // 'User NOT is Logged in, We will use Session';
            $session_id = Session::get('session_id');
            $cartCount = DB::table('carts')->where('session_id', $session_id)->sum('quantity');
        }
        return $cartCount;
    }

    public static function getProductStock($product_id)
    {
        $getProductStock = Store::select('balance')->where('box_id',$product_id)->orderBy('created_at','desc')->first();
        $balance = !empty($getProductStock) ? $getProductStock->balance : 0;
        return $balance;
    }

    public static function deleteCartProduct($product_id, $user_email)
    {
        DB::table('carts')->where(['product_id'=> $product_id, 'user_email'=>$user_email])->delete();
    }

}
