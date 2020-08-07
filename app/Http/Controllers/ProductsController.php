<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Box;
use App\Cap;
use App\Cart;
use App\Commission;
use App\Country;
use App\Coupon;
use App\Delivery_address;
use App\Employee;
use App\Expenses;
use App\Income;
use App\Label;
use App\Lga;
use App\Material;
use App\Order;
use App\Orders_products;
use App\OrdersProduct;
use App\Pay;
use App\Preform;
use App\Processcap;
use App\Processlabel;
use App\Processpreform;
use App\Processpreforms_summary;
use App\Product;
use App\Product_attribute;
use App\Sale;
use App\Setting;
use App\State;
use App\Stock;
use App\Store;
use App\tempCart;
use App\User;
use Carbon\Carbon;
use Cartalyst\Stripe\Stripe;
use Currency\Util\CurrencySymbolUtil;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Classes\fpdf\FPDF;
use PDF;
use Symfony\Component\Intl\Currencies;

class ProductsController extends Controller
{
    public function shop()
    {
        $bottles = Box::all();
        $cart = Session::has('cart') ? Session::get('cart') : null;

        $items = '';
        $total_price = 0;
        if(!empty($cart))
        {
            $items = $cart->items;
            $total_price = $cart->totalPrice;
        }
        return view('frontend.shop.shop', compact('bottles', 'items', 'total_price'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Box::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new tempCart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        $items = $request->session()->get('cart')->items;
        return redirect()->route('shop', compact('items'));
    }

    public function moreToCart(Request $request, $id, $qty)
    {
        $old_qty = Session::get('cart')->items[$id]['qty'];
        $new_qty = $qty - $old_qty;
        $product = Box::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new tempCart($oldCart);
        $cart->addMore($product, $product->id, $new_qty);
        $request->session()->put('cart', $cart);
        $items = $request->session()->get('cart')->items;
        return redirect()->route('shop', compact('items'));
    }

    public function showCart()
    {
        if (!Session::has('cart')) {
            return view('frontend.shop.cart');
        }
        $oldCart = Session::get('cart');

//        dd($oldCart);
        $cart = new tempCart($oldCart);
        $totalPrice = 0;
        foreach ($cart->items as $item) {
            $totalPrice = $totalPrice + $item['price'];
        }
        Session::put('totalPrice', $totalPrice);

        return view('frontend.shop.cart', ['products' => $cart->items, 'totalPrice' => $totalPrice, 'flash_msg_success' => 'Cart has been updated!']);
    }
    public function applyCoupon(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');

        $data = $request->all();
        //Check if This Coupon Code Exist
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        if ($couponCount == 0)
        {
            return redirect()->back()->with('flash_msg_error', 'Coupon is not valid.');
        }else
        {
            //Perform other check like Coupon is active or not, expire or nor

            //If Coupon is active
            $couponDetail = Coupon::where('coupon_code', $data['coupon_code'])->first();
            if ($couponDetail->status == 0)
            {
                return redirect()->back()->with('flash_msg_error', 'Coupon has been deactivated');
            }

            //If Coupon is belongs to this customer
            $user_id = Auth::user()->id;
            $couponUsed = Coupon::where('coupon_code', $data['coupon_code'])->where('user_id',$user_id)->count();
            if ($couponUsed == 0)
            {
                return redirect()->back()->with('flash_msg_error', 'Coupon is in use by some one else.');
            }

            //if Coupon is Expire
            $expire_date = $couponDetail->expire_date;
            $current_date = date('Y-m-d');
            if ($current_date >$expire_date)
            {
                $notification = array(
                    'message' => 'This Coupon is Expired',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with('flash_msg_error', 'This Coupon is Expired');
            }

            //Coupon is valid for discount
//            $session_id = Session::get('session_id');
//            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
//            if (Auth::check())
//            {
//                $user_email = Auth::user()->email;
//                $userCart = DB::table('carts')->where(['user_email'=>$user_email])->get();
//            }else
//            {
//                $session_id = Session::get('session_id');
//                $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
//            }

            $oldCart = Session::get('cart');

            $cart = new tempCart($oldCart);

            $total_amount = 0;
            $total_qty = 0;
            foreach ($cart->items as $item) {
                $total_amount = $total_amount + $item['price'];
                $total_qty = $total_qty + $item['qty'];
            }

            //Check if amount type is Fixed or Percentage
            if($couponDetail->amount_type == 'Fixed')
            {
                $couponAmount = $couponDetail->amount* $total_qty;
            }else
            {
                $couponAmount =$total_amount * ($couponDetail->amount)/100 ;
            }

            //Add coupon code and Amount
            Session::put('couponAmount', $couponAmount);
            Session::put('couponCode', $data['coupon_code']);

            return redirect()->back()->with('flash_msg_success', 'Coupon code Successfully applied. You are availing discount!');
        }
    }

    public function checkout(Request $request)
    {
        if (!Session::has('cart')) {
            return view('frontend.shop.cart');
        }
        $oldCart = Session::get('cart');

        $cart = new tempCart($oldCart);
        $total = Session::get('totalPrice');

        $states = State::all();
        $lgas = Lga::all();


        if ($request->isMethod('POST')) {
            $data = $request->all();

            $gender = !empty($data['gender']) ? $data['gender'] : '' ;

            //Return to checkout page if any of the field is empty
            if (empty($data['billing_name']) || empty($data['billing_address_1']) || empty($data['billing_lga']) ||
                empty($data['billing_state']) ||  empty($data['billing_phone']) ||
                empty($data['payment_method'])) {
                return redirect()->route('checkout')->with('flash_msg_error', 'Please fill all fields to Checkout!');
            }

            //Check if users already exists
            $usersCount = User::where('email', $data['billing_email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_msg_error', 'Email already exist');
            } else
                {
                    /*----- For Returning User ----*/
                    if (Session::has('user'))
                    {
                        $logged_in_user = Session::get('user');
                        $user_id = $logged_in_user->id;
                        $userDetail = User::where('id', $user_id)->first();

                        $userDetail->name = $data['billing_name'];
                        $userDetail->address = $data['billing_address_1'];
                        $userDetail->lga_id = $data['billing_lga'];
                        $userDetail->state_id = $data['billing_state'];
                        $userDetail->gender = $gender;
                        $userDetail->mobile = $data['billing_phone'];
                        $userDetail->company_name = $data['billing_company'];
                        $userDetail->dob = $data['dob'];
                        $userDetail->religion = $data['religion'];
//                        $userDetail->description = $data['order_comments'];
                        $userDetail->save();

                        Session::put('user', $userDetail);
                    }else
                    {
                     /*----- For New User ----*/
                        //Return to checkout page if email is empty
                        if (empty($data['billing_email'])) {
                            return redirect()->route('checkout')->with('flash_msg_warning', 'Please enter your email address');
                        }

                        $user = new User();
                        $user->name = $data['billing_name'];
                        $user->email = $data['billing_email'];
                        $user->password = bcrypt($data['password']);

                        $user->address = $data['billing_address_1'];
                        $user->lga_id = $data['billing_lga'];
                        $user->state_id = $data['billing_state'];
                        $user->gender = $gender;
                        $user->mobile = $data['billing_phone'];
                        $user->company_name = $data['billing_company'];
                        $user->dob = $data['dob'];
                        $user->status = 1;
                        $user->religion = $data['religion'];
                        $user->save();

                        $user_id = DB::getPdo()->lastInsertId();

                        Session::put('user',$user);

                    }

            }
            //Save Order Details
            if (!Session::has('cart')) {
                return redirect()->route('cart');
            }
            $oldCart = Session::get('cart');
            $cart = new tempCart($oldCart);
            $total = Session::get('totalPrice');
            $coupon_amount = Session::has('couponAmount') ? Session::get('couponAmount') : 0;
            $grand_total = $total - $coupon_amount;

            if ($data['payment_method'] == 'paypal') {
                $stripe = Stripe::make('sk_test_51H1v2MKbjSlRmlmYoE4S9gJkAVXeniAhhDe0B4kOt8xh09FzHQh51ZCjWa1abw8GQyZWsLxykZkRFsM5yTF0GxkE00oSejZDc6', '2020-03-02'); // used Stripe secret key, not Publishable key
                $charge = $stripe->charges()->create([
                    'amount'   => $grand_total,
                    'currency' => 'NGN',
                    'source' => $request->stripeToken,
                    'receipt_email' => "admin@cfresh.org",
                ]);

//                return redirect()->route('thanks')->with('flash_msg_info', 'Your order has been placed!');
            }

            if (!Session::has('user'))
            {
                return redirect()->route('checkout')->with('flash_msg_info', 'Please login before continue from here');
            }else
            {
                $user_email = Session::get('user')->email;

                //Prevent out of stock products from ordering
                $userCart = Session::get('cart');

                foreach ($userCart->items as $cart) {
                    $productStock = Product::getProductStock($cart['item']->id);
                    if($productStock == 0)
                    {
//                            Product::deleteCartProduct($cart->product_id, $user_email);
                        return redirect()->route('cart')->with('flash_msg_error', $cart['item']->case  .' is sold out! please choose different product!');
                    }
                    if ($cart['qty'] > $productStock)
                    {
                        return redirect()->route('cart')->with('flash_msg_error', $cart['item']->case .' is not enough for your request! Reduce the quantity and try again.');
                    }
                }

                $coupon_code = Session::has('couponCode') ? Session::get('couponCode') : '';
                $coupon_amount = Session::has('couponAmount') ? Session::get('couponAmount') : 0;
                $order_status = $data['payment_method'] == 'paypal' ? 'Paid' : 'New';

                $order = new Order;
                $order->user_id = $user_id;
                $order->user_email= $user_email;
                $order->name= $data['billing_name'];
                $order->address= $data['billing_address_1'];
                $order->state= $data['billing_state'];
                $order->lga= $data['billing_lga'];
                $order->mobile= $data['billing_phone'];
                $order->coupon_code= $coupon_code;
                $order->coupon_amount= $coupon_amount;
                $order->balance= 0;
                $order->order_status= $order_status;
                $order->payment_method= $data['payment_method'];
                $order->grand_total= $total;
                $order->save();

                $order_id = DB::getPdo()->lastInsertId();

                foreach ($userCart->items as $prod) {
                    $cartPro = new OrdersProduct();
                    $cartPro->order_id = $order_id;
                    $cartPro->user_id = $user_id;
                    $cartPro->product_id = $prod['item']->id;
                    $cartPro->product_name = $prod['item']->case;
                    $cartPro->product_price =$prod['price'];
                    $cartPro->product_qty = $prod['qty'];
                    $cartPro->save();

                    //Reduce Stock Script Starts Here
                    $productStock = DB::table('stores')->where('box_id',$prod['item']->id)->orderBy('id', 'DESC')->first();

                    //Update Stock
                    $new_stock = $productStock->balance - $prod['qty'];
                    $out_flow = new Store();
                    $out_flow->quantity = $prod['qty'];
                    $out_flow->box_id = $prod['item']->id;
                    $out_flow->employee_id = 0;
                    $out_flow->flow = 'Out flow';
                    $out_flow->balance = $new_stock;
                    $out_flow->save();
                }

//                    dd(Session::get('order_id'));

                Session::put('order_id',$order_id);
                Session::put('grand_total',$grand_total);

                $productDetails = Order::with('orders')->where('id',$order_id)->first();

                $userDetail = User::where('id',$user_id)->with('lga')->with('state')->first();

//                $productDetails = json_decode(json_encode($productDetails));
//                echo '<pre>'; print_r($productDetails); die();

              $setting = Setting::find(1);

                /*Code for Order Email Start Here ......*/
                $email = $user_email;
                $messageData = [
                    'email'=>$email,
                    'name'=>$data['billing_name'],
                    'order_id'=>$order_id,
                    'productDetails' => $productDetails,
                    'userDetail' => $userDetail,
                ];

                Mail::send('emails.order', $messageData, function ($message) use($setting, $email){
                    $message->to($email)->subject('Order Placed - '.$setting->site_name);
                });
                /*Code for Order Email Start Here ......*/

                return redirect()->route('thanks')->with('flash_msg_info', 'Your order has been placed!');

        }


        }

        $user = Session::has('user') ? Session::get('user') : '';
        $userDetail = !empty($user) ?  User::where('id',$user->id)->first() : '';
//        dd($userDetail);
        return view('frontend.shop.checkout', ['products' => $cart->items, 'userDetail'=>$userDetail, 'total' => $total, 'states' => $states, 'lgas' => $lgas]);
    }

    public function thanks(Request $request)
    {
//        Session::forget('couponAmount');
//        Session::forget('couponCode');
//        Session::forget('user');
        $logged_in_user = Session::get('user');
        $user_email = $logged_in_user->email;

        if (!Session::has('user'))
        {

            return redirect()->route('checkout')->with('flash_msg_info', 'Please, login to access this page.');
        }
        $order_id =  Session::get('order_id');
        $session_id =  Session::get('session_id');

        $orderDetail = Order::where('id',$order_id)->where('user_email', $user_email)->first();
        $billingDetail = User::where('email', $user_email)->first();

        return view('frontend.shop.thanks', compact('orderDetail', 'billingDetail','userCart'));
    }

    public function orderThanks(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
//        Session::forget('user');

        if (!Session::has('user'))
        {

            return redirect()->route('checkout')->with('flash_msg_info', 'Please, login to access this page.');
        }
        $order_id =  Session::get('order_id');
        $session_id =  Session::get('session_id');
        $user_email = Auth::user()->email;

        $orderDetail = Order::where('id',$order_id)->where('user_email', $user_email)->first();
        $billingDetail = User::where('email', $user_email)->first();



        return view('frontend.shop.thanks', compact('orderDetail', 'billingDetail','userCart'))->with('flash_msg_success', 'An invoice of this order has been sent to your email.');
    }

    public function cardPay(Request $request)
    {
//        $data = $request->all();
        if (!Session::has('cart')) {
            return redirect()->route('cart');
        }
        $oldCart = Session::get('cart');

        $cart = new tempCart($oldCart);
        $total = Session::get('totalPrice');
        Stripe::setApiKey('sk_test_51Gz0HoGKhf8mevfRPoTIltqgdoXaAVnOHHrmvK4bkU3ykU4KQN46SO7xP5viHZ4hjsXzWKLL9Z7RbHSa0AyweLYJ00AFUQaTU3');
        try{
            Charge::create([
                'payment_method_types' => ['card'],
                'amount' => $total * 426.5442,
                'currency' => 'ngn',
                'source'=>$request->input('stripeToken'),
                'description'=>'Test Charge'
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->route('checkout')->with('error',$e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('shop')->with('success','Successfully purchased products');
    }


    public function finishedProducts(Request $request)
    {
        if(Session::has('adminSession'))
        {
            if ($request->isMethod('post'))
            {

                $data = $request->all();
                $case_id = $data['product_type'];
                $qty = $data['quantity'];
                $store_keeper = $data['store_keeper'];
                $comment = $data['comment'];

                $stockCount = Preform::where('box_id', $case_id)->where('open',0)->count();
                $stockCountLabel = Label::where('box_id', $case_id)->where('open',0)->count();
                $stockCountCap = Cap::where('open',0)->count();
                if ($stockCount <=0 || $stockCountLabel<=0 || $stockCountCap<=0)
                {
                    $notification = array(
                        'message' => 'One or more of the raw materials is/are insufficient in stock! for this type of product',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                //=================================== PREFORM ===================================================
                //Materials currently in stock
//            $tot_preform = Preform::where('box_id',$case_id)->where('open',0)->sum('tot_preform');
                $batch_preform = Preform::where('box_id',$case_id)->where('open',0)->get();

                //Get the material used
                $preform_used = 12*$qty;
                $label_used = 12*$qty;
                $cap_used = 12*$qty;

                $min_preform =  $batch_preform->min('tot_preform');
                $max_preform =  $batch_preform->max('tot_preform');
                $preform = Preform::where('tot_preform',$min_preform)->first();
                $kg_per_bag = $preform->kg_per_bag;
                $preform_g = $preform->preform_g;

                if ($min_preform >= $preform_used)
                {
                    //Get the remaining material
                    $preform_remains = $min_preform - $preform_used;
                    $no_bags_remains = $preform_remains * $preform_g/($kg_per_bag*1000);
                    $total_kg_remains = $no_bags_remains*$kg_per_bag;
                    Preform::where('tot_preform',$min_preform)->update(['tot_preform'=>$preform_remains,
                        'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);

                }elseif($max_preform > $preform_used)
                {
                    //Get the remaining material
                    $max_preform = $max_preform+$min_preform;
                    $preform_remains = $max_preform - $preform_used;
                    $no_bags_remains = $preform_remains * $preform_g/($kg_per_bag*1000);
                    $total_kg_remains = $no_bags_remains*$kg_per_bag;
                    Preform::where('tot_preform',$min_preform)->update(['tot_preform'=>0,
                        'no_bags'=>0, 'total_kg'=>0, 'open'=>1]);
                    Preform::where('tot_preform',$max_preform)->update(['tot_preform'=>$preform_remains,
                        'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);
                }

                if ($max_preform < $preform_used)
                {
                    $notification = array(
                        'message' => 'Preform available in stock is insufficient',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                //=================================== CAP ===================================================
                //Materials currently in stock
//            $tot_cap = Cap::where('box_id',$case_id)->where('open',0)->sum('tot_preform');
                $batch_cap = Cap::where('open',0)->get();

                $min_cap =  $batch_cap->min('tot_cap');
                $max_cap =  $batch_cap->max('tot_cap');
                $cap = Cap::where('tot_cap',$min_cap)->first();
                $kg_per_bag = $cap->kg_per_bag;
                $cap_g = $cap->cap_g;

                if ($min_cap >= $cap_used)
                {
                    //Get the remaining material
                    $cap_remains = $min_cap - $cap_used;
                    $no_bags_remains = $cap_remains * $cap_g/($kg_per_bag*1000);
                    $total_kg_remains = $no_bags_remains*$kg_per_bag;
                    Cap::where('tot_cap',$min_cap)->update(['tot_cap'=>$cap_remains,
                        'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);

                }elseif($max_cap > $cap_used)
                {
                    //Get the remaining material
                    $max_cap = $max_cap+$min_cap;
                    $cap_remains = $max_cap - $cap_used;
                    $no_bags_remains = $cap_remains * $cap_g/($kg_per_bag*1000);
                    $total_kg_remains = $no_bags_remains*$kg_per_bag;
                    Cap::where('tot_cap',$min_cap)->update(['tot_cap'=>0,
                        'no_bags'=>0, 'total_kg'=>0, 'open'=>1]);
                    Cap::where('tot_cap',$max_cap)->update(['tot_cap'=>$cap_remains,
                        'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);
                }

                if ($max_cap < $cap_used)
                {
                    $notification = array(
                        'message' => 'Cap available in stock is insufficient',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                //=================================== LABEL ===================================================
                //Materials currently in stock
//            $tot_cap = Cap::where('box_id',$case_id)->where('open',0)->sum('tot_preform');
                $batch_label = Label::where('box_id',$case_id)->where('open',0)->first();

//                $min_label =  $batch_label->min('tot_label');
//                $max_label =  $batch_label->max('tot_label');
//                $label = Label::where('tot_label',$min_label)->first();
                $kg_per_bag = $batch_label->kg_per_bag;
                $label_g = $batch_label->label_g;
                $tot_label_stock = $batch_label->tot_label;

//                if ($min_label >= $label_used)
//                {
                //Get the remaining material
                $label_remains = $tot_label_stock - $label_used;
                $no_bags_remains = $label_remains * $label_g/($kg_per_bag*1000);
                $total_kg_remains = $no_bags_remains*$kg_per_bag;
                Label::where('box_id',$case_id)->where('open',0)->update(['tot_label'=>$label_remains,
                    'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);

//                }elseif($max_label > $label_used)
//                {
                //Get the remaining material
//                    $max_label = $max_label+$min_label;
//                    $label_remains = $max_label - $label_used;
//                    $no_bags_remains = $label_remains * $label_g/($kg_per_bag*1000);
//                    $total_kg_remains = $no_bags_remains*$kg_per_bag;
//                    Label::where('tot_label',$min_label)->update(['tot_label'=>0,
//                        'no_bags'=>0, 'total_kg'=>0, 'open'=>1]);
//                    Label::where('tot_label',$max_label)->update(['tot_label'=>$label_remains,
//                        'no_bags'=>$no_bags_remains, 'total_kg'=>$total_kg_remains]);
//                }

                if ($tot_label_stock < $label_used)
                {
                    $notification = array(
                        'message' => 'Label available in stock is insufficient',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                $old_balance = !empty(Store::latest('created_at')->where('box_id',$case_id)->first()) ? Store::latest('created_at')->where('box_id',$case_id)->first()->balance : 0;
                $balance_new = $old_balance +  $qty;

                $store = new Store();
                $store->quantity = $qty;
                $store->box_id = $case_id;
                $store->employee_id = $store_keeper;
                $store->flow = 'In flow';
                $store->balance = $balance_new;

                $store->save();

                $notification = array(
                    'message' => 'Products has been moved to the store successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            }

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        $cases = Box::all();
        $employees = Employee::all();
        return view('admin.products.finished_product', compact('cases', 'employees'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('adminSession'))
        {
            $case_ids = Box::all();
            $cap = Processcap::where('is_open','!=',1)->sum('no_cap');
            $label =Processlabel::where('is_open','!=',1)->sum('no_label');
            $preform=[];
            $data=[];

            $preforms =Processpreform::where('is_open',0)->first();
            $i = 0;

            if (!empty($preforms))
            {
                foreach ($case_ids as $case_id)
                {
//                dd($case_id->id);
                    $preform[] =Processpreform::where('box_id',$case_id->id)->where('is_open',0)->sum('no_preform');
                    $data[] = ['no_preform'=>$preform[$i], 'case'=>$case_id->case, 'no_cases'=>$preform[$i]/12];

                    $summary = Processpreforms_summary::where('box_id',$case_id->id)->first();
                    if (empty($summary))
                    {
                        $new_product = new  Processpreforms_summary();
                        $new_product->box_id = $case_id->id;
                        $new_product->no_preform = $preform[$i];
                        $new_product->no_cap =$cap;
                        $new_product->no_label =$label;

                        $new_product->save();
                    }else
                    {
                        $summary->no_preform = $preform[$i];
                        $summary->no_cap =$cap;
                        $summary->no_label =$label;

                        $summary->save();
                    }

                    $i+=1;
                }
            }
            Processpreform::where('is_open','=',0)->update(['is_open' => 1]);
            Processcap::where('is_open','=',0)->update(['is_open' => 1]);
            Processlabel::where('is_open','=',0)->update(['is_open' => 1]);
        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        /*===================== SET is_open to 1 ===========================*/

        $employees = Employee::all();
        $materials = Material::all();
        $cases = Box::all();
        $summaries = Processpreforms_summary::all();
        return view('admin.products.create', compact('materials','cases','summaries','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'no_cases'=>'required',
        ]);

        $case_id=$request->case_id;
        $no_cases=$request->no_cases;
        $comment=$request->comments;
        $employee_id=$request->employee_id;

        /*GET THE KG EQUIVALENT OF THIS CASES FOR PREFORM, CAP AND LABEL*/
        /*REMOVE THESE KGS FROM IN-PROCESS FOR EACH MATERIALS*/

        /*Preform kg*/
        $preform = Processpreform::latest('created_at')->first();
        $preform_g = $preform->preform_g;

//        $case_id=$preform->box_id;

//        dd($case_id);

        $preform_kg_case = $no_cases*12*$preform_g/1000;
        $preform_kg_process = $preform->kg_bags;
        $preform_kg_remains = $preform_kg_process-$preform_kg_case;
        $preform_no = $preform_kg_remains*1000/$preform_g;

        $preform->kg_bags = $preform_kg_remains;
        $preform->no_preform = $preform_no;

        $preform->save();

        /*Cap kg*/
        $cap = Processcap::latest('created_at')->first();
        $cap_g = $cap->cap_g;

        $cap_kg_case = $no_cases*12*$cap_g/1000;
        $cap_kg_process = $cap->kg_bags;
        $cap_kg_remains = $cap_kg_process-$cap_kg_case;
        $cap_no = $cap_kg_remains*1000/$cap_g;

        $cap->kg_bags = $cap_kg_remains;
        $cap->no_cap = $cap_no;

        $cap->save();

        /*Label kg*/
        $label = Processlabel::latest('created_at')->first();
        $label_g = $label->label_g;

        $label_kg_case = $no_cases*12*$label_g/1000;
        $label_kg_process = $label->kg_bags;
        $label_kg_remains = $label_kg_process-$label_kg_case;
        $label_no = $label_kg_remains*1000/$label_g;

        $label->kg_bags = $label_kg_remains;
        $label->no_label = $label_no;

        $label->save();

        /*===================================Processpreforms_summary Table START======================================*/
        $no_preform_used = $no_cases*12;
        $no_cap_used = $no_cases*12;
        $no_label_used = $no_cases*12;

        $p_summary = Processpreforms_summary::where('box_id', $case_id)->first();


//        Processpreforms_summary::where('is_open','=',0)->update(['is_open' => 1]);

        $no_preform_remain = $p_summary->no_preform - $no_preform_used;
        $no_cap_remain = $p_summary->no_cap - $no_cap_used;
        $no_label_remain = $p_summary->no_label- $no_label_used;

        $p_summary->no_preform = $no_preform_remain;
        $p_summary->no_cap = $no_cap_remain;
        $p_summary->no_label = $no_label_remain;
        $p_summary->save();
        /*===================================Processpreforms_summary Table END======================================*/

        $product = Product::create([
            'box_id'=>$case_id,
            'no_cases'=>$no_cases,
            'comment'=>$comment,
        ]);

        $old_balance = !empty(Store::latest('created_at')->where('box_id',$case_id)->first()) ? Store::latest('created_at')->where('box_id',$case_id)->first()->balance : 0;
        $balance_new = $old_balance +  $no_cases;
        Store::create([
            'quantity'=>$no_cases,
            'box_id'=>$case_id,
            'employee_id'=>$employee_id,
            'flow'=>'In flow',
            'balance'=>$balance_new
        ]);



        $notification = array(
            'message' => 'Product successfully Saved!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function viewOrders(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                $search = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $search =  Order::with('orders')->whereBetween('created_at', [$from, $to])->get();
//                dd($search);
                return view('admin.orders.view-orders',['ViewsPage' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
//                $PDFReport = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $PDFReport = Order::with('orders')->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $total_income = array_sum(array_column($PDFReport, 'amount_paid'));
                $total_balance = array_sum(array_column($PDFReport, 'balance'));
                $pdf = PDF::loadView('admin.orders.view_order_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_income'=>$total_income, 'total_balance'=>$total_balance])->setPaper('a4', 'landscape');
                return $pdf->download('Orders-report.pdf');
            }
        }
        else
        {
            //select all
            $ViewsPage = Order::with('orders')->get();
            return view('admin.orders.view-orders',['ViewsPage' => $ViewsPage]);
        }

//        $orders = Order::with('orders')->orderBy('id', 'desc')->get();
//        return view('admin.orders.view-orders', compact('orders'));
    }

//    public function pdf_order_history()
//    {
//        $pdfView = DB::select('SELECT * FROM orders');
//        $pdf = PDF::loadView('admin.orders.order_history_pdfview', ['pdfViews'=> $pdfView])
//            ->setPaper('a4','landscape');
//        return $pdf->download('report.pdf');
//    }

    public function viewOrderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where(['id'=>$order_id])->first();
        $billingsDetails = User::where(['id'=>$orderDetails->user_id])->first();
        $shippingDetails = Delivery_address::where(['user_id'=>$orderDetails->user_id])->first();
        $employees = Employee::all();
        $user = User::where('id',$orderDetails->user_id)->first();
//        $orderDetails = json_decode(json_encode($orderDetails));
//        echo '<pre>'; print_r($orderDetails); die();
        return view('admin.orders.order_details', compact('orderDetails','user', 'billingsDetails', 'shippingDetails','employees'));
    }

    public function viewOrderInvoice($order_id)
    {
        $orderDetails = Order::with('orders')->where(['id'=>$order_id])->first();
        $billingsDetails = User::where(['id'=>$orderDetails->user_id])->first();
        $shippingDetails = Delivery_address::where(['user_id'=>$orderDetails->user_id])->first();
//        $orderDetails = json_decode(json_encode($orderDetails));
//        echo '<pre>'; print_r($orderDetails); die();
        return view('admin.orders.order_invoice', compact('orderDetails', 'billingsDetails', 'shippingDetails'));
    }

    public function viewPdfInvoice($order_id)
    {
        $orderDetails = Order::with('orders')->where(['id'=>$order_id])->first();
        $billingsDetails = User::where(['id'=>$orderDetails->user_id])->first();
        $shippingDetails = Delivery_address::where(['user_id'=>$orderDetails->user_id])->first();
//        $orderDetails = json_decode(json_encode($orderDetails));
//        echo '<pre>'; print_r($orderDetails); die();
        $old_balance = User::getUsersOldBalanace($orderDetails->user_id);

        $output = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cfresh</title>
    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url("images/logo/dimension.png");
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logo/Cfresh-label.png">
      </div>
      <h1>INVOICE #'.$orderDetails->id.'</h1>
      <div id="project" class="clearfix">
       <div><span>Order ID</span> # '.$orderDetails->id.'</div>
        <div><span>Order Date</span> '.\Carbon\Carbon::parse($orderDetails->created_at)->toFormattedDateString().' - ('.\Carbon\Carbon::parse($orderDetails->created_at)->format("h:i A").') </div>
        <div><span>Order Amount</span>NGN <strong>'.number_format($orderDetails->grand_total, 2).'</strong></div>
        <div><span>Order Status</span>'.$orderDetails->order_status.'</div>
        <div><span>Payment Method</span>'.$orderDetails->payment_method.'</div>
        <div><span>Amount Paid</span>NGN '.number_format($orderDetails->amount_paid, 2).'</div>
        <div><span>Balance</span>NGN<strong  style="color: red"> '.number_format($orderDetails->balance, 2).'</strong></div>
      </div>
      <div id="project" style="float: right">
        <div><strong>Delivery Address</strong></div>
        <div>'.$orderDetails->name.'</div>
        <div>'.$orderDetails->address.'</div>
         <div>'.$orderDetails->lga.', ' .$orderDetails->state. '. ('. $orderDetails->pincode.'). </div>
         <div>'.$orderDetails->mobile.'</div>
      </div>
    </header>
    <main>
      <table class="table" >
        <thead>
          <tr>
            <th class="desc">PRODUCT</th>
            <th class="service">PRICE</th>
            <th class="service">QTY</th>
            <th class="service">TOTAL</th>
          </tr>
        </thead>
        <tbody>';
        $subTotal = 0;
        foreach ($orderDetails->orders as $order) {
            $output .= '<tr>
            <td class="desc">'.$order->product_name.'</td>
            <td class="service">NGN '.number_format($order->product_price, 2).'</td>
            <td class="service">'.$order->product_qty.'</td>
            <td class="service">NGN '.number_format(($order->product_qty)*($order->product_price), 2).'</td>
          </tr>';
            $subTotal =$subTotal + $order->product_qty*$order->product_price;
        }
        $output .= '        
          <tr>
           <td style="text-align: left">OLD BALANCE:</td>
            <td style="text-align: left; color: red">NGN '.number_format($old_balance - $orderDetails->balance, 2).'</td>
            <td style="">SUBTOTAL:</td>
            <td style="">NGN '.number_format($subTotal, 2).'</td>
          </tr>    
           <tr>
            <td style="text-align: left">NEW BALANCE:</td>
            <td style="text-align: left; color: red">NGN '.number_format($orderDetails->balance, 2).'</td>
            <td >DISCOUNT (-): </td>
            <td class="total">NGN '.number_format($orderDetails->coupon_amount, 2).'</td>
          </tr>
          <tr>
           <td class="grand total" style="text-align: left">TOTAL BALANCE:</td>
            <td class="grand total" style="text-align: left; color: red">NGN '.number_format($old_balance,2).'</td>
            <td  class="grand total">GRAND TOTAL</td>
            <td class="grand total">NGN '.number_format($orderDetails->grand_total, 2).'</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Payments made with in 48 hours of delivery will attract 1% discount. </div>
      </div>
    </main>
 
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->setOptions( )

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream();
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            //if status is Paid then Amount and Received By must be entered
//dd($data);
            $order = Order::where('id',$data['order_id'])->first();
            if($order->payment_method == 'Cash on Delivery'){
                $cash_type = 'Cash';
            }else
            {
                $cash_type = 'Wired';
            }
            $grand_total = $order->grand_total;
            $employee_id = empty($data['employee_id']) ? 0 : $data['employee_id'];
            $amount_paid = empty($data['amount_paid']) ? 0 : $data['amount_paid'];
            $qty = $order->orders->sum('product_qty');

            $balance = 0;
            $temp_balance = 0;
            if ($data['order_status'] == 'Delivered'){
                $temp_balance = $order->grand_total;
                Order::where('id',$data['order_id'])->update(['order_status'=>'Delivered']);
            }

            if ($data['order_status'] == 'Paid')
            {
                if (empty($data['employee_id'] ))
                {
                    $notification = array(
                        'message' => 'Please select the employee that received the payment!',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }
                if (empty($data['amount_paid'] ))
                {
                    $notification = array(
                        'message' => 'Please enter the amount paid!',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                //Update Balance in Order Table
                $balance = $grand_total - $amount_paid;

                //Get User Old Balance
                $user_old_balance = User::getUsersOldBalanace($data['user_id']);
                $user_new_balance = $user_old_balance + $balance;

                /*Update Customer Old Balance*/
                User::where('id',$data['user_id'])->update(['old_balance'=>$user_new_balance]);

                //Update Sales Table
                $sale = new Sale();
                $sale->employee_id = $employee_id;
                $sale->user_id = $data['user_id'];
                $sale->order_id = $data['order_id'];
                $sale->qty =$qty;
                $sale->amount_expected = $grand_total;
                $sale->discount = $order->coupon_amount;
                $sale->amount_paid = $amount_paid;
                $sale->save();

                //                 Update Commission Table
                $employee = Employee::where('id',$employee_id)->first();

                if(!empty($employee->category))
                {
                    $employeePaymentType = $employee->category->payment->id;
                    $salary_amount = $employee->category->amount;
                    $factor = $employee->factor;
                    $today = Carbon::today()->format('Y-m-d');


                    $commission_today = Commission::where('employee_id',$data['employee_id'])
                        ->whereDay('created_at',today())->first();

                    if (!empty($commission_today))
                    {
                        $old_qty = $commission_today->qty;
                        $new_qty = $old_qty+$qty;

                        $old_commission = $commission_today->commission;
                        $new_commission = $qty*$factor + $old_commission;

                        $old_salary = $commission_today->salary_amount;
                        $new_salary =$employee->category->amount;

                        $old_total = $commission_today->salary_total;
                        $new_total = $new_commission + $new_salary;

                        //Update Commission
//                         if ($employeePaymentType == 1)
//                         {
                        Commission::where('employee_id',$data['employee_id'])->update([
                            'qty'=>$new_qty, 'commission'=>$new_commission,'salary_amount'=>$new_salary,
                            'factor'=>$factor,'salary_total'=>$new_total,
                        ]);
//                         }
//                         elseif($employeePaymentType != 1 || $employeePaymentType != 2)
//                         {
//                             $salary_total = $salary_amount + $qtySum*$factor;
//                             Commission::where('employee_id',$data['employee_id'])->update([
//                                 'qty'=>$new_qty, 'commission'=>$new_commission,'salary_amount'=>$new_salary,
//                                 'factor'=>$factor,'salary_total'=>$new_total,
//                             ]);
//
//                         }
                    }else
                    {
                        //Create Commission
                        if ($employeePaymentType == 1)
                        {
                            $commission = new Commission();
                            $commission->employee_id = $employee_id;
                            $commission->qty = $qty;
                            $commission->factor = $factor;
                            $commission->commission = $qty*$factor;
                            $commission->salary_amount = $employee->category->amount;
                            $commission->salary_total =$qty*$factor + $employee->category->amount;
                            $commission->save();
                        }
//                         elseif($employeePaymentType != 1 || $employeePaymentType != 2)
//                         {
//                             $commission = new Commission();
//                             $commission->employee_id = $employee_id;
//                             $commission->qty = $qtySum;
//                             $commission->factor = $factor;
//                             $commission->commission = $qtySum*$factor;
//                             $commission->salary_amount = $salary_amount;
//                             $commission->salary_total = $salary_amount + $qtySum*$factor;
//                             $commission->save();
//                         }
                    }
                }

                //Update Employee Balance
                $new_balance = 0;
                $employee = Employee::where('id',$employee_id)->first();
                $old_balance = $employee->balance;
                $new_balance = $qty*$factor + $employee->category->amount + $old_balance;
                $employee->balance = $new_balance;
                $employee->save();

                $pay = Pay::where('employee_id', $employee_id)->where('status',0)->first();

                if (!empty($pay) ) {
                    $old_pay = $pay->amount;
                    $new_pay = $old_pay + $qty*$factor;

                    //Update
                    Pay::where('employee_id', $employee_id)->where('status',0)->update(['amount' => $new_pay]);
                } else {
                    //Create New
                    Pay::create([
                        'employee_id' => $employee_id,
                        'amount' => $qty*$factor + $employee->category->amount,
                    ]);
                }


            }elseif ($data['order_status'] == 'Cancelled')
            {
                $adminUser = Admin::getUser(Session::get('adminSession'))->employee_id;

                $pro_orders = OrdersProduct::where('order_id',$data['order_id'])->get();
                foreach ($pro_orders as $pro_order) {
                    $case_id = $pro_order->product_id;
                    $product_qty = $pro_order->product_qty;
                    Store::updateReturningStore($product_qty, $case_id, $adminUser);
                }

                Store::OrderCancelled($data['order_id']);
                OrdersProduct::where('order_id',$data['order_id'])->delete();
                Order::where('id',$data['order_id'])->delete();

                $notification = array(
                    'message' => 'Order has been successfully Cancelled!',
                    'alert-type' => 'info'
                );

                return redirect()->route('admin.viewOrders')->with($notification);
            }

//            $order = Order::where('id',$data['order_id'])->first();
            //Update Income Table
            if ($order->order_status == 'Paid')
            {
                $amount_paid= $order->amount_paid;
                $bal = $grand_total - $amount_paid;
//                $bal_new = $order->balance - $bal;

                Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status'],'balance'=>0,
                    'employee_id'=>$employee_id, 'amount_paid'=>0, 'trans_date'=>today()]);

                Income::where('order_id', $data['order_id'])->delete();

                //Get User Old Balance
                $user_old_balance = User::getUsersOldBalanace($data['user_id']);
                $user_new_balance = $user_old_balance + $bal;

                /*Update Customer Old Balance*/
                User::where('id',$data['user_id'])->update(['old_balance'=>$user_new_balance]);

            }
            else
            {
                Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status'],'balance'=>$balance,
                    'employee_id'=>$employee_id, 'amount_paid'=>$amount_paid]);

                $income = new Income();
                $income->amount = $amount_paid;
                $income->user_id = $data['user_id'];
                $income->type = 'C-fresh';
                $income->cash_type = $cash_type;
                $income->employee_id = $employee_id;
                $income->order_id = $data['order_id'];
                $income->description = 'A Sales of '. $qty .  ' Cases was made on '. Carbon::parse($order->created_at)->toFormattedDateString();
                $income->save();

                if ($order->coupon_amount != 0)
                {
                    $expens_amount = $order->coupon_amount;
                    $expenses = new Expenses();
                    $expenses->amount = $expens_amount;
                    $expenses->description = 'Amount lost due to Discount';
                    $expenses->user_id = $data['user_id'];
                    $expenses->type = 'C-fresh';
                    $expenses->cash_type = 'Discount Lost';
                    $expenses->expense_date = today();
                    $expenses->employee = '';
                    $expenses->save();
                }

            }


            $notification = array(
                'message' => 'Order Status has been Updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function productStore(Request $request)
    {
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        $employees = Employee::all();
        $cases = Box::all();
        $products = Store::get();

        $first = \App\Box::all()->first()->id;
        $last = \App\Box::all()->last()->id;
        $prod_sum[] = array();


        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
                $search =  Store::with('box')->whereBetween('created_at', [$from, $to])->get();
                return view('admin.products.index',['products' => $search, 'cases'=>$cases]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
//                $PDFReport = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $PDFReport = Store::with('employee')->with('box')->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $balance_closing[] = array();
                $balance_opening[] = array();
                $in_flow[] = array();
                $out_flow[] = array();



                for ($i=$first; $i<= $last; $i++)
                {
                    $balance_closing['prod'.$i] = Store::where('box_id',$i)->whereBetween('created_at', [$from, $to])->latest()->first()->balance;
                    $balance_opening['prod'.$i] = Store::where('box_id',$i)->whereBetween('created_at', [$from, $to])->first()->balance;
                    $in_flow['prod'.$i] = Store::where('box_id',$i)->where('flow','In flow')->whereBetween('created_at', [$from, $to])->sum('quantity');
                    $out_flow['prod'.$i] = Store::where('box_id',$i)->where('flow','Out flow')->whereBetween('created_at', [$from, $to])->sum('quantity');
                }

                $pdf = PDF::loadView('admin.products.store_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'balance_opening'=>$balance_opening, 'balance_closing'=>$balance_closing, 'in_flow'=>$in_flow, 'out_flow'=>$out_flow, 'cases'=>$cases])
                    ->setPaper('a4', 'landscape');




                return $pdf->download('store-report.pdf');
            }
        }
        else
        {
            //select all
//            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.products.index', compact('employees','cases','products'));
        }

    }

    public function detail($id=null)
    {
        $product = Box::where('id',$id)->first();
        $storeCount = Store::where('box_id',$id)->orderBy('created_at','desc')->first();

        if (!empty($storeCount))
        {
            $balance = $storeCount->balance;
        }else
        {
            $notification = array(
                'message' => 'This Item is not Available in store. ',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        return view('frontend.products.detail', compact('product','balance'));
    }

    public function cart(Request $request)
    {
        $session_id = Session::get('session_id');

//        if (Auth::check())
//        {
//            $user_email = Auth::user()->email;
//            $userCarts = DB::table('carts')->where('user_email',$user_email)->get();
//        }else
//        {
//            $session_id = Session::get('session_id');
//            $userCarts = DB::table('carts')->where(['session_id'=>$session_id])->get();
//        }
        $userCarts = DB::table('carts')->where(['session_id'=>$session_id])->get();
        foreach ($userCarts as $key =>$product) {
            $productDetail = Box::where('id',$product->box_id)->first();
            $userCarts[$key]->image = $productDetail->image;
            $stock = Store::where('box_id',$product->box_id)->orderBy('created_at','desc')->first();

            $userCarts[$key]->stock = $stock->balance;
        }

//        dd($userCarts);
        return view('frontend.products.cart', compact('userCarts','stock'));
    }

    public function deleteCartProduct($id=null)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        Cart::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product has been deleted from Cart!',
            'alert-type' => 'success'
        );

        return redirect()->route('cart')->with($notification);
    }

    public function updateCartQuantity($id=null, $qty=null)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        DB::table('carts')->where('id',$id)->increment('quantity',$qty);

        $notification = array(
            'message' => 'Product Quantity has been updated from Cart!',
            'alert-type' => 'success'
        );

        return redirect()->route('cart')->with($notification);
    }

    public function orderReview(Request $request)
    {
//        $session_id = Session::get('session_id');
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetail = User::where('id', $user_id)->first();
        $states = State::all();
        $lgas = Lga::all();
        $shippingDetail = Delivery_address::where('user_id', $user_id)->first();
        $userCart = DB::table('carts')->where('user_email',$user_email)->get();

//        $shippingDetail = Delivery_address::where('user_id', $user_id)->first();
//        $userCart = DB::table('carts')->where('user_email',$user_email)->where(['session_id'=>$session_id])->get();

        foreach ($userCart as $key =>$product) {
            $productDetail = Box::where('id',$product->box_id)->first();
            $userCart[$key]->image = $productDetail->image;
        }
//        dd($userCart);
        return view('frontend.products.order_review', compact('userDetail', 'shippingDetail', 'states', 'lgas', 'userCart'));
    }

    public function placeOrder(Request $request)
    {

        $setting = Setting::find(1);

        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            //Prevent out of stock products from ordering
            $userCart = Cart::where('user_email',$user_email)->get();

            foreach ($userCart as $cart) {
                $productStock = Product::getProductStock($cart->box_id);
                if($productStock == 0)
                {
                    Product::deleteCartProduct($cart->product_id, $user_email);
                    return redirect()->route('cart')->with('flash_msg_error','One of the product is sold out and it will be remove from your cart! please choose different product!');
                }
                if ($cart->quantity > $productStock)
                {
                    return redirect()->route('cart')->with('flash_msg_error','Product available is not enough for one of your request! Reduce the quantity and try again.');
                }
            }

            //Get Shipping Address of User
            $shippingDetail = Delivery_address::where('user_id', $user_id)->first();

            $coupon_code = !empty($data['coupon_code']) ? $data['coupon_code'] : '';
            $coupon_amount = !empty($data['coupon_amount']) ? $data['coupon_amount'] : 0;

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email= $user_email;
            $order->name= $shippingDetail->name;
            $order->address= $shippingDetail->address;
            $order->state= $shippingDetail->state->name;
            $order->lga= $shippingDetail->lga->name;
            $order->mobile= $shippingDetail->mobile;
            $order->pincode= $shippingDetail->pincode;
            $order->coupon_code= $coupon_code;
            $order->coupon_amount= $coupon_amount;
            $order->balance= 0;
            $order->order_status= "New";
            $order->payment_method= $data['payment_method'];
            $order->grand_total= $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProduct = DB::table('carts')->where(['user_email'=>$user_email])->get();
            foreach ($cartProduct as $prod) {
                $cartPro = new OrdersProduct();
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $prod->box_id;
                $cartPro->product_name = $prod->product_name;
                $cartPro->product_price = $prod->price;
                $cartPro->product_qty = $prod->quantity;
                $cartPro->save();

                //Reduce Stock Script Starts Here
//                $productStock = Store::latest('created_at')->where('box_id',$prod->box_id)->last();
                $productStock = DB::table('stores')->where('box_id',$prod->box_id)->orderBy('id', 'DESC')->first();
//                dd($productStock);

                //Update Stock
                $new_stock = $productStock->balance - $prod->quantity;
                $out_flow = new Store();
                $out_flow->quantity = $prod->quantity;
                $out_flow->box_id = $prod->box_id;
                $out_flow->employee_id = 0;
                $out_flow->flow = 'Out flow';
                $out_flow->balance = $new_stock;
                $out_flow->save();
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if ($data['payment_method'] == 'Cash On Delivery')
            {
                $productDetails = Order::with('orders')->where('id',$order_id)->first();

                $userDetails = User::where('id',$user_id)->with('lga')->with('state')->first();
//                $userCountry = $userDetails->country->country_name;
//dd($user_id);
//                $productDetails = json_decode(json_encode($productDetails));
//                echo '<pre>'; print_r($productDetails); die();

                /*Code for Order Email Start Here ......*/
                $email = $user_email;
                $messageData = [
                    'email'=>$email,
                    'name'=>$shippingDetail->name,
                    'order_id'=>$order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails,
                ];

                Mail::send('emails.order', $messageData, function ($message) use($setting, $email){
                    $message->to($email)->subject('Order Placed - '.$setting->site_name);
                });
                /*Code for Order Email Start Here ......*/
                $notification = array(
                    'message' => 'Order Placed',
                    'alert-type' => 'success'
                );

                return redirect()->route('thanks')->with($notification);

            }else if($data['payment_method'] == 'paypal')
            {
                //Redirect user to pay pal page
                return redirect()->back();
            }
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            dd($data);
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password'], 'status'=>'1']))
            {
                $userDetail = User::where('email',$data['email'])->first();
                if ($userDetail->status == 0)
                {
                    return redirect()->back()->with('flash_msg_error','Your account is not activated! Please confirm your email to activate your account!');
                }
                Session::put('user',$userDetail);
                return redirect()->back()->with('flash_msg_success','You are logged in successfully.');

            }else
            {
                return redirect()->route('checkout')->with('flash_msg_error','Invalid Username or Password');
            }
        }
    }

    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','desc')->get();
//        $orders = json_decode(json_encode($orders));
//        echo '<pre>'; print_r($orders); die();
        return view('frontend.orders.users_orders',compact('orders'));
    }

    public function ordersDetails($order_id)
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
//        echo '<pre>'; print_r($orderDetails); die();
//        dd('Deeee');
        return view('frontend.orders.order_details', compact('orderDetails'));
    }

    /*public function orderHistory($id)
    {
        $user = User::findOrFail($id);
        $user_orders = Order::where('user_id', $id)->with('orders')->get();
        $user_orders = json_decode(json_encode($user_orders));
//        dd($admin_user);
//        echo '<pre>'; print_r( $user_orders[0]->user_id); die();
        return view(' admin.orders.order_history',compact('user_orders', 'user'));
    }*/

    public function orderHistory(Request $request, $id)
    {
        $first = \App\Box::all()->first()->id;
        $last = \App\Box::all()->last()->id;
        $prod_sum[] = array();


        $user = User::findOrFail($id);
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                $search = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $search =  Order::with('orders')->where('user_id',$id)->whereBetween('created_at', [$from, $to])->get();
//                dd($search);
                return view('admin.orders.order_history',['ViewsPage' => $search, 'user'=>$user]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
//                $PDFReport = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $PDFReport = Order::with('orders')->where('user_id',$id)->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $total_amount = array_sum(array_column($PDFReport, 'grand_total'));
                $total_paid = array_sum(array_column($PDFReport, 'amount_paid'));
                $total_discount = array_sum(array_column($PDFReport, 'coupon_amount'));
                $total_balance = array_sum(array_column($PDFReport, 'balance'));

                for ($i=$first; $i<= $last; $i++)
                {
                    $prod_sum['prod'.$i] = OrdersProduct::with('orders')->where('user_id',$id)
                        ->whereBetween('created_at', [$from, $to])->where('product_id',$i)->sum('product_qty');
                }

//                $prod_sum = (object)$prod_sum;
//                dd($prod_sum['prod2']);
                $pdf = PDF::loadView('admin.orders.order_history_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to, 'total_discount'=>$total_discount, 'user'=>$user,
                    'total_amount'=>$total_amount, 'prod_sum'=>$prod_sum, 'total_paid'=>$total_paid, 'total_balance'=>$total_balance])->setPaper('a4', 'landscape');
                return $pdf->download('Order_history-report.pdf');
            }
        }
        else
        {
            //select all
            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.orders.order_history',['ViewsPage' => $ViewsPage, 'user'=>$user]);
        }
    }


}
