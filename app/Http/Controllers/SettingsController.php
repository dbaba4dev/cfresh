<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        $setting = Setting::first();
        return view('admin.settings.settings', compact('setting'));
    }

    public function update_info(Request $request)
    {
        $settings = Setting::first();
        $settings->site_name = $request->site_name;
        $settings->contact_number = $request->contact_number;
        $settings->contact_email = $request->contact_email;
        $settings->contact_address = $request->contact_address;

        $settings->save();

        $notification = array(
            'message' => 'Settings updated successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update_commission(Request $request)
    {
//        dd($request->all());
        $settings = Setting::first();
        $settings->commission_factor = $request->commission_factor;

        $settings->save();

        $notification = array(
            'message' => 'Commission record updated successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
