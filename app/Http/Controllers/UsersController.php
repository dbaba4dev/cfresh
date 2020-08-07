<?php

namespace App\Http\Controllers;

//use App\Profile;
use App\Lga;
use App\Profile;
use App\Setting;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('admin');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        $users = User::all();
        return view('admin.users.index', compact('users'));
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

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        return view('admin.users.create');
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
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        $rules =array(
            'name'=>'required|unique:users',
            'email'=>'required|unique:users|email'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'images/users/avatar.png'
        ]);


        $notification = array(
            'message' => 'User created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);

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
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required'

        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/avatars', $new_image_name);
            $user->profile->avatar = 'uploads/avatars/'.$new_image_name;
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->profile->address=$request->address;
        $user->profile->phone=$request->phone;

        $user->profile->save();

        if ($request->has('password'))
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $notification = array(
            'message' => 'User Account updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);

    }


    public function showLoginRegister()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $settings = Setting::find(1);

            //Check if users already exists
            $usersCount = User::where('email',$data['email'])->count();
            if ($usersCount>0)
            {
                $notification = array(
                    'message' => 'Email already exist',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }else
            {
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();



                //Send Register Email Status
//                $email = $data['email'];
//                $messageData = ['email'=>$data['email'], 'name'=>$data['name']];
//                Mail::send('emails.register', $messageData, function ($message) use($settings, $email){
//                    $message->to($email)->subject('Registration with ' . $settings->site_name);
//                });

                //Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'], 'name'=>$data['name'], 'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation', $messageData, function ($message) use($email){
                    $message->to($email)->subject('Confirm your C-fresh Account');
                });

                return redirect()->route('user.login')->with('flash_msg_success','Please Confirm your email to activate your account!');
//                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
//                {
//                    Session::put('frontSession',$data['email']);
//                    $notification = array(
//                        'message' => 'You are logged in',
//                        'alert-type' => 'success'
//                    );
//
//                    return redirect()->route('cart')->with($notification);
//                }
            }
        }

    }

    public function confirmAccount($email)
    {
        $settings = Setting::find(1);
        $email = base64_decode($email);
        $usersCount = User::where('email',$email)->count();
        if ($usersCount > 0)
        {
            $usersDetails = User::where('email',$email)->first();
            if ($usersDetails->status == 1)
            {
                return redirect()->route('user.login')->with('flash_msg_success','You Email account is already activated. You can login now.');
            }else
            {
                User::where('email',$email)->update(['status'=>'1']);

                //Send Welcome Email Status
                $messageData = ['email'=>$email, 'name'=>$usersDetails->name ];
                Mail::send('emails.welcome', $messageData, function ($message) use($settings, $email){
                    $message->to($email)->subject('Welcome to '. $settings->site_name);
                });

                return redirect()->route('user.login')->with('flash_msg_success','Your Email account is activated. You can login now.');
            }
        }else
        {
            abort(404);;
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
                $userStatus = User::where('email',$data['email'])->first();
                if ($userStatus->status == 0)
                {
                    return redirect()->back()->with('flash_msg_error','Your account is not activated! Please confirm your email to activate your account!');
                }
                Session::put('frontSession',$data['email']);
                return redirect()->route('cart')->with('flash_msg_success','You are logged in');
            }else
            {
                return redirect()->back()->with('flash_msg_error','Invalid Username or Password');
            }
        }

        return view('users.login');
    }

    public function forgotPassword(Request $request)
    {
        $setting = Setting::find(1);
        if ($request->isMethod('post'))
        {

            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount == 0)
            {
                return redirect()->back()->with('flash_msg_error','Email does not exists!');
            }else
            {
                //Get User Details
                $userDetails = User::where('email',$data['email'])->first();

                //Generate random password
                $random_password = Str::random(8);

                //Encode Password
                $new_password = bcrypt($random_password);

                //Update Password
                User::where('email', $data['email'])->update(['password'=>$new_password]);

                //Send Forget Password Email Code
                $email = $data['email'];
                $name = $userDetails->name;
                $messageData = ['email'=>$email, 'password'=>$random_password, 'name'=>$name];
                Mail::send('emails.forgotPassword', $messageData, function ($message)use($setting, $email){
                    $message->to($email)->subject('New Password - '.$setting->site_name);
                });
                return redirect()->back()->with('flash_msg_success','Your Password was reset and the new password has been sent to your email.');
            }
        }
        return view('users.forgot_password');
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        if ($request->isMethod('post'))
        {
            $request->validate([
                'name' => ['required'],
                'mobile' => ['required', 'unique:users'],
                'state_id' => ['required'],
                'lga_id' => ['required'],
                'address' => ['required'],
            ]);

            $data=$request->all();


            User::where('id',$user_id)->update(['name'=>$data['name'],'address'=>$data['address'],'lga_id'=>$data['lga_id'],
                'state_id'=>$data['state_id'],'pincode'=>$data['pincode'],'mobile'=>$data['mobile']]);

            $notification = array(
                'message' => 'User Record updated Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }


        $user = User::where('id',$user_id)->first();
        $states=State::all();
        $lgas = Lga::all();

        return view('users.account', compact('user','states', 'lgas'));
    }

    public function getLgas($id)
    {
        $lgas = DB::table("lgas")->where("state_id",$id)->pluck("name","id");
        return json_encode($lgas);
    }

    public function checkPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_id = Auth::user()->id;
        $check_password = User::where('id',$user_id)->first();

        if (Hash::check($current_password, $check_password->password))
        {
            echo 'true';
//            dd('true');
        }else
        {
            echo 'false';
//            dd('false');
        }
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            dd($data);
            $user_id = Auth::user()->id;
            $old_password = User::where('id',$user_id)->first();
            $current_password = $data['current_password'];
            if (Hash::check($current_password, $old_password->password))
            {
                //Update Password
                $new_password = bcrypt($data['new_password']);
                User::where('id',$user_id)->update(['password'=>$new_password]);
                $notification = array(
                    'message' => 'Password updated successfully!',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }else
            {
                //Get Out
                $notification = array(
                    'message' => 'Current Password is incorrect!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

        }
    }

    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users.customers', compact('users'));
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('couponAmount');
        Session::forget('couponCode');
        Session::forget('session_id');
        Session::flush();
        $notification = array(
            'message' => 'You have been logged out',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);
    }

}
