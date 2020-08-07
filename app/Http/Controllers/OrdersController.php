<?php

namespace App\Http\Controllers;

use App\Box;
use App\Customer;
use App\Delivery_address;
use App\Employee;
use App\Invoice;
use App\Invoice_detail;
use App\Order;
use App\Profile;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Classes\fpdf\FPDF;
use Illuminate\Support\Facades\Auth;

//use LaravelDaily\Invoices\Classes\Buyer;
//use LaravelDaily\Invoices\Classes\InvoiceItem;
//use LaravelDaily\Invoices\Invoice;

class OrdersController extends Controller
{

    public function placeOrder(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
//            dd($data);
            //Get Shipping Address of User
            $shippingDetail = Delivery_address::where('user_id', $user_id)->first();

            $coupon_code = !empty($data['coupon_code']) ? $data['coupon_code'] : '';
            $coupon_amount = !empty($data['coupon_amount']) ? $data['coupon_amount'] : '';

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email= $user_email;
            $order->name= $shippingDetail->name;
            $order->address= $shippingDetail->address;
            $order->state= $shippingDetail->state;
            $order->city= $shippingDetail->city;
            $order->country= $shippingDetail->country->country_name;
            $order->mobile= $shippingDetail->mobile;
            $order->pincode= $shippingDetail->pincode;
            $order->coupon_code= $coupon_code;
            $order->coupon_amount= $coupon_amount;
            $order->shipping_charges= 0;
            $order->order_status= "New";
            $order->payment_method= $data['payment_method'];
            $order->grand_total= $data['grand_total'];
            $order->save();
//            return redirect()->route('checkout')->with('flash_msg_error','Please fill all fields to Checkout!');
            return redirect()->back()->with('flash_msg_success','Order Placed');
        }
    }



}
