<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\User;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function addCoupon(Request $request)
    {
        $users = User::where('status',1)->where('admin',0)->get();
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            //Check if This Coupon Code Exist
            $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
//            dd($couponCount);
            if ($couponCount > 0)
            {
                $notification = array(
                    'message' => 'This Code has already been taken. ',
                    'alert-type' => 'warning'
                );

                return redirect()->back()->with($notification);
            }

            //Check if This User has an active coupon
            $couponCount = Coupon::where('user_id', $data['user_id'])->where('status',1)->where('expire_date','>',today())->count();
            if ($couponCount > 0)
            {
                $notification = array(
                    'message' => 'This Customer has an active coupon. ',
                    'alert-type' => 'info'
                );

                return redirect()->back()->with($notification);
            }


            $status = !empty($data['status']) ? $data['status'] : 0;
            $coupon = new Coupon();
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->user_id = $data['user_id'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expire_date =$data['expire_date'];
            $coupon->status = $status;
            $coupon->save();

            $notification = array(
                'message' => 'Coupon added successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.viewCoupons')->with($notification);
        }
        return view('admin.coupons.add_coupon', compact('users'));
    }

    public function viewCoupons()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.view_coupons', compact('coupons'));
    }

    public function updateCoupon(Request $request, $id=null)
    {
        $coupon = Coupon::find($id);
        $users = User::where('status',1)->where('admin',0)->get();
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $status = !empty($data['status']) ? $data['status'] : 0;
            Coupon::where('id',$coupon->id)->update(['coupon_code'=>$data['coupon_code'], 'amount'=>$data['amount'],
                'user_id'=>$data['user_id'],'amount_type'=>$data['amount_type'], 'expire_date'=>$data['expire_date'], 'status'=>$status]);

            $notification = array(
                'message' => 'Coupon Updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.viewCoupons')->with($notification);
        }
        return view('admin.coupons.edit_coupon', compact('coupon','users'));
    }

    public function deleteCoupon($id=null)
    {
        Coupon::find($id)->delete();
        $notification = array(
            'message' => 'Coupon deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.viewCoupons')->with($notification);
    }
}
