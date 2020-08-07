<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Session::has('adminSession')))
        {
            return redirect()->route('admin.login');
        }else
        {
            //Get admin details
            $adminDetails = \App\Admin::where('username', Session::get('adminSession'))->first();

            if ($adminDetails['type']=='Admin')
            {
                $adminDetails['employees_access'] = 3;
                $adminDetails['products_access'] = 3;
                $adminDetails['orders_access'] = 3;
                $adminDetails['finance_access'] = 3;
                $adminDetails['users_access'] = 3;
                $adminDetails['inventories_view_access'] = 1;
                $adminDetails['inventories_manage_access'] = 1;
                $adminDetails['store_view_access'] = 1;
                $adminDetails['store_move_access'] = 1;
                $adminDetails['operation_access'] = 1;
            }
            Session::put('adminDetails', $adminDetails);

            //Get Current Path
            $currentPath = Route::getFacadeRoot()->current()->uri();
            if(Request::is('admin/view-users') && Session::get('adminDetails')['users_access']==0)
            {
                $notification = array(
                    'message' => 'You have no access for this module.',
                    'alert-type' => 'error'
                );

                return redirect()->route('admin.dashboard')->with($notification);
            }
            if($currentPath=="admin/view-products" && Session::get('adminDetails')['products_access']==0)
            {
                return redirect()->route('admin.dashboard')->with('flash_msg_error', 'You have no access for this module.');
            }


        }
        return $next($request);

//        if (Auth::check()){
//            if (Auth::user()->admin != 1) {
//                $notification = array(
//                    'message' => 'You do not have permissions to perform this action.',
//                    'alert-type' => 'info'
//                );
//
//                return redirect()->route('admin.login')->with($notification);
//            }
////            return redirect()->route('admin.login');
//        }
//        return $next($request);
    }
}
