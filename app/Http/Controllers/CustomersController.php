<?php

namespace App\Http\Controllers;

use App\Account;
use App\Admin;
use App\Area;
use App\Box;
use App\Category;
use App\Commission;
use App\Coupon;
use App\Customer;
use App\CustomerCategory;
use App\Employee;
use App\Income;
use App\Lga;
use App\Order;
use App\OrdersProduct;
use App\Pay;
use App\Profile;
use App\Sale;
use App\State;
use App\Store;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('status',1)->where('admin',0)->get();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        $employees=Employee::all();
        $categories=CustomerCategory::all();
        $areas=Area::all();

        if (count($areas) == 0)
        {
            $notification = array(
                'message' => 'You must have one or more Customer Area(s) added before creating customer',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }
        return view('admin.customers.create',compact('customers', 'areas', 'employees','categories'));
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
        $this->validate($request,[
            'name'=>'required|unique:customers',
            'area_id'=>'required',
            'customer_category_id'=>'required',
            'employee_id'=>'required'
        ]);

        $customer = Customer::create([
            'name'=>$request->name,
            'area_id'=>$request->area_id,
            'employee_id'=>$request->employee_id,
            'customer_category_id'=>$request->customer_category_id,
            'nick_name'=>$request->nick_name,
            'company'=>$request->company,
            'credit_limit'=>$request->credit_limit
        ]);

        $avatar = '';

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/customers/images', $new_image_name);
            $avatar = 'uploads/customers/images/'.$new_image_name;
        }else{
            $avatar = 'uploads/customers/avatar2.png';
        }

        $profile = Profile::create([
            'customer_id'=>$customer->id,
            'avatar'=>$avatar,
            'address'=>$request->address,
            'phone'=>$request->phone
        ]);

        $notification = array(
            'message' => 'Customer created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer=Customer::findOrFail($id);
        $employees=Employee::all();
        $areas=Area::all();
        $categories = CustomerCategory::all();
//        $bags=Customer_summary::where('customer_id',$id)->latest('updated_at')->get();

        return view('admin.customers.edit',compact('customer', 'employees','areas','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $this->validate($request, [
            'name'=>'required',
            'area_id'=>'required',
            'employee_id'=>'required'

        ]);

        $customer = Customer::findOrFail($id);

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/customers/images', $new_image_name);
            $customer->profile->avatar = 'uploads/customers/images/'.$new_image_name;
        }

        $customer->name=$request->name;
        $customer->area_id=$request->area_id;
        $customer->employee_id=$request->employee_id;
        $customer->credit_limit=$request->credit_limit;
        $customer->customer_category_id=$request->category_id;
        $customer->nick_name=$request->nick_name;
        $customer->company=$request->company;

        $customer->profile->customer_id=$id;
        $customer->profile->address=$request->address;
        $customer->profile->phone=$request->phone;

        $customer->save();

        $customer->profile->save();

        $notification = array(
            'message' => 'Customer record updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->profile->delete();
        $customer->delete();

        $notification = array(
            'message' => 'Customer record deleted and backup in trashed can.',
            'alert-type' => 'warning'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function trashes()
    {
        $customers = Customer::onlyTrashed()->get();
        $profiles = Profile::onlyTrashed()->get();
        return view('admin.customers.deactivated', compact('customers','profiles'));
    }

    public function restore($id)
    {
        $customer = Customer::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('customer_id',$id)->onlyTrashed()->first();

        $customer->restore();
        $profile->restore();

        $notification = array(
            'message' => 'Customer record restored!!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function delete($id)
    {
        $customer = Customer::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('customer_id',$id)->onlyTrashed()->first();


        $profile->forceDelete();
        $customer->forceDelete();

        $notification = array(
            'message' => 'Permanently deleted Customer record!!',
            'alert-type' => 'error'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function createCustomerStep1(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();

            //Check if users already exists
            $usersCount = User::where('email',$data['email'])->count();
            if ($usersCount>0)
            {
                return redirect()->back()->with('flash_msg_error','Email already exist.');

            }else
            {
                $user = new User();
                $user->name = $data['customer_name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                $id = $user->id;

                $notification = array(
                    'message' => 'Customer account was created successfully.',
                    'alert-type' => 'success'
                );

                $userDetail = User::where('id',$id)->first();
//dd($id);
                return redirect()->to('customers/create/step2/'.$id)->with('userDetail', $userDetail)->with($notification);
            }

        }
        return view('admin.customers.create');
    }
    public function createCustomerStep2(Request $request, $id)
    {
        $user_id = $id;
        if ($request->isMethod('post'))
        {
            $data = $request->all();

            if (!empty($data['gender']))
            {
                $gender = 'Male';
            }else
            {
                $gender = 'Female';
            }
            //Look for the user and update it
            $user = User::where('id', $user_id)->update([
                'address'=>$data['address'],
                'mobile'=>$data['phone'],
                'lga_id'=>$data['lga'],
                'state_id'=>$data['state'],
                'gender'=>$gender,
                'religion'=>$data['religion'],
                'dob'=>$data['dob'],
                'status'=>$data['status']
            ]);

            $notification = array(
                'message' => 'Customer Information updated successfully.',
                'alert-type' => 'success'
            );

            $userDetail = User::where('id',$id)->first();
            return redirect()->to('customers/create/step3/'.$id)->with('userDetail', $userDetail)->with($notification);

        }
        $states = State::all();
        $lgas = Lga::all();
        if (!empty($user_id))
        {
            $userDetail = User::where('id',$user_id)->first();
        }
        return view('admin.customers.create_step2', compact('states', 'lgas','userDetail'))->with(['id'=>$id]);
    }
    public function createCustomerStep3(Request $request, $id)
    {
        $user_id = $id;
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $vendor = !empty($data['employee']) ? $data['employee'] : '';

            //Look for the user and update it
            $user = User::where('id', $user_id)->update([
                'vendor'=>$vendor
            ]);

            $notification = array(
                'message' => 'Customer Information updated successfully.',
                'alert-type' => 'success'
            );

            return redirect()->route('customers.place_order')->with($notification);

        }
        $states = State::all();
        $lgas = Lga::all();
        if (!empty($user_id))
        {
            $userDetail = User::where('id',$user_id)->first();
        }
        $employees = Employee::where('category_id',1)->get();
        $coupons = Coupon::where('status',1)->get();
        return view('admin.customers.create_step3', compact('employees', 'coupons', 'userDetail'))->with(['id'=>$id]);
    }


    public function place_order(Request $request)
    {
        $rows = Box::all();
        $coupons = Coupon::where('status',1)->get();
        $customers = User::where('admin',0)->where('status',1)->get();
        $employees = Employee::where('category_id',1)->get();
        return view('admin.customers.place_order', compact('customers', 'rows', 'coupons', 'employees'));
    }

    public function addNewRow(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            if (isset($data['getNewOrderItem']))
            {
                $rows = Box::all();
//                dd($rows);
                ?>
                    <tr>
                        <td><b class="number">1</b></td>
                        <td>
                            <select name="pid[]" id="" class="form-control form-control-sm pid" required>
                                <option value="" selected disabled>Choose Product</option>
                                <?php
                                foreach ($rows as $row) {
                                    ?> <option value="<?php echo $row->id; ?>"><?php echo $row->case; ?></option> <?php
                                    }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>
                        <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required></td>
                        <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
                        <td hidden><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name" ></td>
                        <td>&#8358 <span class="amt">0</span></td>
                    </tr>
                <?php
                    exit();
            }
        }
    }

    public function getPriceAndQty(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $id = $data['id'];
            $customer_id = $data['customer_id'];
            $coupon_arr = array();
//            dd($id);
            if (isset($data['getPriceQty'])) {
                $product = Store::with('box')->where('box_id', $id)->latest('id')->first();
                echo json_encode($product);
                exit();
            }
        }
    }

    /*public function getDiscount(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $total_qty = $data['qty'];
            $sub_total = $data['sub_tot'];
            $id = $data['code'];
            $couponAmount = 0;

            if ($data['code'] != 0) {
                $coupon = Coupon::where('id', $id)->first();
                //Check if amount type is Fixed or Percentage
                if($coupon->amount_type == 'Fixed')
                {
                    $couponAmount = $coupon->amount* (int)($total_qty);
                }else
                {
                    $couponAmount =(float)($sub_total) * ($coupon->amount)/100 ;
                }
            }
            echo $couponAmount;
            exit();
        }
    }*/
    public function getCoupon(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $customer_id = $data['id'];
            $coupon_arr = array();
            $amount_type = '';
            $couponCode = '';
            $couponAmount = 0;

            if (!empty($customer_id)) {
                $coupon = Coupon::where('user_id', $customer_id)->first();
                $sales_rep_id = User::where('id',$customer_id)->first()->vendor;
                $sales_rep_name = Employee::where('id',$sales_rep_id)->first()->name;
                //Check if amount type is Fixed or Percentage
                /*if($coupon->amount_type == 'Fixed')
                {
                    $couponAmount = $coupon->amount* (int)($total_qty);
                }else
                {
                    $couponAmount =(float)($sub_total) * ($coupon->amount)/100 ;
                }*/
                if (!empty($coupon)){
                    $couponAmount = $coupon->amount;
                    $couponCode = !empty($coupon->coupon_code) ? $coupon->coupon_code : null;
                    $amount_type =!empty( $coupon->amount_type) ?  $coupon->amount_type : null;
                }
                $coupon_arr = [$couponCode, $couponAmount, $amount_type, $sales_rep_id, $sales_rep_name];

            }
//            $coupon_arr = json_decode(json_encode($coupon_arr));
//            echo '<pre>'; print_r($coupon_arr);
            echo json_encode($coupon_arr);
            exit();
        }
    }

    public function order_place(Request $request)
    {
         if ($request->isMethod('post') ) { //&& isset($request->user_id)
             $data = $request->all();
             $customer_id = $data['user_id'];
             $customer = User::where('id',$customer_id)->first();
             $admin = Admin::with('employee')->where('username',Session::get('adminSession'))->first();

             /*Geting Array from Order Form*/
             $ar_tqty = $data['tqty'];
             $ar_qty = $data['qty'];
             $ar_price = $data['price'];
             $ar_pro_name = $data['pro_name'];

             $sub_total = $data['sub_total'];
//             $coupon_code = !empty($data['code']) ? Coupon::where('id',$data['code'])->first()->coupon_code : '';
             $coupon_code = !empty($customer->coupon) ? $customer->coupon->coupon_code : null;
             $discount = $data['discount'];
             $net_tot = $data['net_total'];
             $paid = $data['paid'];
             $employee_id = !empty($data['employee_id']) ? $data['employee_id'] : 0;
             $balance = (double)$data['balance'];
             $payment_method = $data['payment_method'];
             $order_status = $data['paid'] > 0 ? 'Paid' : 'New';
             $new_total = 0;

             //Check the Authenticity of the coupon
             if (!empty($coupon_code))
             {
                 //Check if This Coupon Code Exist
                 $couponCount = Coupon::where('coupon_code', $coupon_code)->count();
                 if ($couponCount == 0)
                 {
                     return redirect()->back()->with('flash_msg_error', 'Coupon is not valid.');
                 }else
                 {
                     //Perform other check like Coupon is active or not, expire or nor

                     //If Coupon is active
                     $couponDetail = Coupon::where('coupon_code', $coupon_code)->first();
                     if ($couponDetail->status == 0)
                     {
                         return redirect()->back()->with('flash_msg_error', 'Coupon has been deactivated');
                     }

                     //If Coupon is belongs to this customer
                     $couponUsed = Coupon::where('coupon_code',$coupon_code)->where('user_id',$customer_id)->count();
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

                 }

                 /*Saving the data into Order Table*/
                 $order = new Order;
                 $order->user_id = $customer_id;
                 $order->user_email= $customer->email;
                 $order->name= $customer->name;
                 $order->address= $customer->address;
                 $order->state= $customer->state->name;
                 $order->lga= $customer->lga->name;
                 $order->mobile= $customer->mobile;
                 $order->coupon_amount= $discount;
                 $order->balance= $balance;
                 $order->amount_paid= $paid;
                 $order->employee_id= $employee_id;
                 $order->order_status= $order_status;
                 $order->pincode= '000000';
                 $order->coupon_code= $coupon_code;
                 $order->payment_method= $payment_method;
                 $order->grand_total= $net_tot;
                 $order->trans_date= today();
                 $order->save();

                 $order_id = DB::getPdo()->lastInsertId();

                 if ($paid == 0)
                 {
                     $order_status = 'New';
                     $amount_paid = 0;
                 }else
                 {
                     $order_status = 'Paid';
                     $amount_paid = $paid;

                     if($payment_method == 'Cash on Delivery'){
                         $cash_type = 'Cash';
                     }else
                     {
                         $cash_type = 'Wired';
                     }


                     Income::create(['amount'=>$paid,'user_id'=>$admin->id, 'order_id'=>$order_id, 'description'=>$admin->employee->name . ' placed an order for a customer named; '. $customer->name,
                         'type'=>'', 'cash_type'=>$cash_type, 'employee_id'=>$data['employee_id'], 'inc_date'=>today()]);

                     $qtySum = 0;
                     foreach ($data['pid'] as $key=>$value) {

                         $qtySum = $qtySum + $ar_qty[$key];
                     }

                     //Update Sales Table
                     $sale = new Sale();
                     $sale->employee_id = $employee_id;
                     $sale->user_id = $customer_id;
                     $sale->order_id = $order_id;
                     $sale->qty = $qtySum;
                     $sale->amount_expected = $net_tot;
                     $sale->discount = $order->coupon_amount;
                     $sale->amount_paid = $paid;
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
                             $new_qty = $old_qty+$qtySum;

                             $old_commission = $commission_today->commission;
                             $new_commission = $qtySum*$factor + $old_commission;

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
                                 $commission->qty = $qtySum;
                                 $commission->factor = $factor;
                                 $commission->commission = $qtySum*$factor;
                                 $commission->salary_amount = $employee->category->amount;
                                 $commission->salary_total =$qtySum*$factor + $employee->category->amount;
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
                     $new_balance = $qtySum*$factor + $employee->category->amount + $old_balance;
                     $employee->balance = $new_balance;
                     $employee->save();

                     $pay = Pay::where('employee_id', $employee_id)->where('status',0)->first();

                     if (!empty($pay) ) {
                         $old_pay = $pay->amount;
                         $new_pay = $old_pay + $qtySum*$factor;

                         //Update
                         Pay::where('employee_id', $employee_id)->where('status',0)->update(['amount' => $new_pay]);
                     } else {
                         //Create New
                         Pay::create([
                             'employee_id' => $employee_id,
                             'amount' => $qtySum*$factor + $employee->category->amount,
                         ]);
                     }

                 }

                 //Update Pay Table
//             $commission_today = Commission::where('employee_id', $employee_id)->whereDay('created_at', today())->get();
//        if (!empty($commission_today)) {
//            foreach ($commission_today as $commission) {
//                $employee_id = $commission->employee_id;
//                $commission_amount = $commission->commission;
//                $salary_amount = $commission->salary_amount;
//                $salary_amount = empty($salary_amount) ? 0 : $salary_amount;
//                $commission_amount = empty($commission_amount) ? 0 : $commission_amount;
//                $amount = $commission_amount + $salary_amount;
//
//            }
             }

             /*Saving the data into Order Table*/
             $order = new Order;
             $order->user_id = $customer_id;
             $order->user_email= $customer->email;
             $order->name= $customer->name;
             $order->address= $customer->address;
             $order->state= $customer->state->name;
             $order->lga= $customer->lga->name;
             $order->mobile= $customer->mobile;
             $order->coupon_amount= $discount;
             $order->balance= $balance;
             $order->amount_paid= $paid;
             $order->employee_id= $employee_id;
             $order->order_status= $order_status;
             $order->pincode= '000000';
             $order->coupon_code= $coupon_code;
             $order->payment_method= $payment_method;
             $order->grand_total= $net_tot;
             $order->trans_date= today();
             $order->save();

             $order_id = DB::getPdo()->lastInsertId();

             if ($paid == 0)
             {
                 $order_status = 'New';
                 $amount_paid = 0;
             }else
             {
                 $order_status = 'Paid';
                 $amount_paid = $paid;

                 if($payment_method == 'Cash on Delivery'){
                     $cash_type = 'Cash';
                 }else
                 {
                     $cash_type = 'Wired';
                 }


                 Income::create(['amount'=>$paid,'user_id'=>$admin->id, 'order_id'=>$order_id, 'description'=>$admin->employee->name . ' placed an order for a customer named; '. $customer->name,
                     'type'=>'', 'cash_type'=>$cash_type, 'employee_id'=>$data['employee_id'], 'inc_date'=>today()]);

             }


             $qtySum = 0;
             foreach ($data['pid'] as $key=>$value) {

                 $qtySum = $qtySum + $ar_qty[$key];
             }

             //Update Sales Table
             $sale = new Sale();
             $sale->employee_id = $employee_id;
             $sale->user_id = $customer_id;
             $sale->order_id = $order_id;
             $sale->qty = $qtySum;
             $sale->amount_expected = $net_tot;
             $sale->discount = $order->coupon_amount;
             $sale->amount_paid = $paid;
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
                     $new_qty = $old_qty+$qtySum;

                     $old_commission = $commission_today->commission;
                     $new_commission = $qtySum*$factor + $old_commission;

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
                         $commission->qty = $qtySum;
                         $commission->factor = $factor;
                         $commission->commission = $qtySum*$factor;
                         $commission->salary_amount = $employee->category->amount;
                         $commission->salary_total =$qtySum*$factor + $employee->category->amount;
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
             $new_balance = $qtySum*$factor + $employee->category->amount + $old_balance;
             $employee->balance = $new_balance;
             $employee->save();

             $pay = Pay::where('employee_id', $employee_id)->where('status',0)->first();

             if (!empty($pay) ) {
                 $old_pay = $pay->amount;
                 $new_pay = $old_pay + $qtySum*$factor;

                 //Update
                 Pay::where('employee_id', $employee_id)->where('status',0)->update(['amount' => $new_pay]);
             } else {
                 //Create New
                 Pay::create([
                     'employee_id' => $employee_id,
                     'amount' => $qtySum*$factor + $employee->category->amount,
                 ]);
             }

             //Update Pay Table
//             $commission_today = Commission::where('employee_id', $employee_id)->whereDay('created_at', today())->get();
//        if (!empty($commission_today)) {
//            foreach ($commission_today as $commission) {
//                $employee_id = $commission->employee_id;
//                $commission_amount = $commission->commission;
//                $salary_amount = $commission->salary_amount;
//                $salary_amount = empty($salary_amount) ? 0 : $salary_amount;
//                $commission_amount = empty($commission_amount) ? 0 : $commission_amount;
//                $amount = $commission_amount + $salary_amount;
//
//            }
        }

         foreach ($data['pid'] as $key=>$value) {
             if (!empty($value))
             {
                 OrdersProduct::create([
                     'order_id'=>$order->id,
                     'product_id'=>$value,
                     'user_id'=>$customer_id,
                     'product_name'=>$ar_pro_name[$key],
                     'product_price'=>$ar_price[$key],
                     'product_qty'=>$ar_qty[$key],
                 ]);

                 /*Update Store after moving the ordered qty to the customer*/
                 Store::updateRemainingStore($ar_qty[$key], $value, $employee_id);

             }
         }

         //if Paid Update User Table Balance
         if ($amount_paid != 0)
         {
             //Get User Old Balance
             $user_old_balance = User::getUsersOldBalanace($customer_id);
             $user_new_balance = $user_old_balance + $balance;

             /*Update Customer Old Balance*/
             User::where('id',$data['user_id'])->update(['old_balance'=>$user_new_balance]);
         }



         $notification = array(
             'message' => 'Order Placed',
             'alert-type' => 'success'
         );

         return redirect()->back()->with($notification);

    }
}

                ?>

