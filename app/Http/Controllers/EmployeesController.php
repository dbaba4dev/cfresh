<?php

namespace App\Http\Controllers;

use App\Account;
use App\Bank;
use App\Category;
use App\Employee;
use App\Order;
use App\OrdersProduct;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = Employee::all();
//        dd($employee->profile->avatar);
        return view('admin.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $employees = Employee::all();

        $categories = Category::all();

        $banks = Bank::all();

        return view('admin.employees.create',compact('employees','categories','banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name'=>'required|unique:employees',
            'phone'=>'required',
            'joined'=>'required',
            'category_id'=>'required',
            'address'=>'required',
            'avatar'=>'required|image'
        ]);

        $employee = Employee::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'account_no'=>$request->account_no,
            'account_name'=>$request->account_name,
            'bank_id'=>$request->bank_id,
            'target'=>$request->target,
            'joined'=>Carbon::parse($request->joined)->format('Y-m-d H:i:s'),
        ]);

        $avatar = '';

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/employees/images', $new_image_name);
            $avatar = 'uploads/employees/images/'.$new_image_name;
        }


        $profile = Profile::create([
            'employee_id'=>$employee->id,
            'avatar'=>$avatar,
            'address'=>$request->address,
            'phone'=>$request->phone
        ]);

//        $employee->customers()->attach($request->customers());

        $notification = array(
            'message' => 'Employee created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employees')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit_sales(Request $request, $id)
    {
        $employee = Employee::where('id',$id)->first();
        $categories =Category::all();
        $banks = Bank::all();
        $orders = Order::with('orders')->where('employee_id', $id)->get();

        $target =(($employee->target)*(Carbon::now()->day))/Carbon::now()->daysInMonth;

        $accounts = Account::where('employee_id',$id)->get();

        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                dd($from);
                $search =  Order::with('orders')->where('employee_id', $id)->whereBetween('created_at', [$from, $to])->get();
                return view('admin.employees.edit',['orders' => $search, 'employee'=>$employee, 'categories' => $categories,
                    'banks'=>$banks, 'target'=>$target, 'accounts'=>$accounts]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
                $PDFReport = Order::with('orders')->with('employee')->where('employee_id', $id)->whereBetween('created_at', [$from, $to])->get();
                $orders = $PDFReport;
                $total[] = array();
                $PDFReport = json_decode(json_encode($PDFReport));

                foreach ($PDFReport as $order) {
                    foreach ($order->orders as $order1) {
                        $total[] = $order1->product_qty;
                    }
                }
                 $total_quantity = array_sum($total);
                $pdf = PDF::loadView('admin.employees.edit_pdfview', ['PDFReport' => $orders, 'from'=>$from, 'to'=>$to,
                    'total_quantity'=>$total_quantity, 'employee'=>$employee, 'categories' => $categories,
                    'banks'=>$banks, 'target'=>$target, 'accounts'=>$accounts])->setPaper('a4', 'landscape');
                return $pdf->download('sales-report.pdf');
            }
        }
        else
        {
            //select all
//            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.employees.edit',compact('employee', 'categories','banks','orders','target','accounts'));
        }


    }

    public function edit_account(Request $request, $id)
    {
        $employee = Employee::where('id',$id)->first();
        $balance = $employee->balance;
        $categories =Category::all();
        $banks = Bank::all();
        $orders = Order::with('orders')->where('employee_id', $id)->get();

        $target =(($employee->target)*(Carbon::now()->day))/Carbon::now()->daysInMonth;

        $accounts = Account::where('employee_id',$id)->get();

        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                dd($from);
                $search =  Account::with('employee')->where('employee_id', $id)->whereBetween('created_at', [$from, $to])->get();
                return view('admin.employees.edit',['orders' => $orders, 'employee'=>$employee, 'categories' => $categories,
                    'banks'=>$banks, 'target'=>$target, 'balance'=>$balance, 'accounts'=>$search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
                $PDFReport = Account::with('admin')->where('employee_id', $id)->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $total_amount = array_sum(array_column($PDFReport, 'amount'));

//                foreach ($PDFReport as $order) {
//                    dd($order->orders->sum('product_qty'));
//                }
//                $total_quantity = $PDFReport[0]->orders->sum( 'product_qty');

                $pdf = PDF::loadView('admin.employees.edit_account_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount, 'employee'=>$employee, 'categories' => $categories,
                    'banks'=>$banks, 'target'=>$target, 'balance'=>$balance, 'orders'=>$orders])->setPaper('a4', 'landscape');
                return $pdf->download('account-report.pdf');
            }
        }
        else
        {
            //select all
//            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.employees.edit',compact('employee', 'balance', 'categories','banks','orders','target','accounts'));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'phone'=>'required',
            'joined'=>'required',
            'category_id'=>'required',
            'address'=>'required'

        ]);

        $employee = Employee::findOrFail($id);
        $profile = Profile::where('employee_id',$id)->first();

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/employees/images', $new_image_name);
            $profile->avatar = 'uploads/employees/images/'.$new_image_name;
        }

        $address = $request->address;

        $employee->name=$request->name;
        $employee->category_id=$request->category_id;
        $employee->account_no=$request->account_no;
        $employee->account_name=$request->account_name;
        $employee->bank_id=$request->bank_id;
        $employee->joined=$request->joined;
        $employee->target=$request->target;
        $employee->factor=$request->factor;

        $profile->employee_id=$id;
        $profile->address=$address;
        $profile->phone=$request->phone;

        $employee->save();

        $profile->save();

        $notification = array(
            'message' => 'Employee details updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employees')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        Profile::where('employee_id',$id)->delete();
//        $employee->profile->delete();
        $employee->delete();

        $notification = array(
            'message' => 'Employee information trashed!',
            'alert-type' => 'warning'
        );

        return redirect()->route('employees')->with($notification);
    }

    public function trashes()
    {
        $employees = Employee::onlyTrashed()->get();
        $profiles = Profile::onlyTrashed()->get();
        return view('admin.employees.deactivated', compact('employees','profiles'));
    }

    public function restore($id)
    {
        $employee=Employee::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('employee_id',$id)->onlyTrashed()->first();

        $employee->restore();
        $profile->restore();

        $notification = array(
            'message' => 'Employee information Restored!',
            'alert-type' => 'info'
        );

        return redirect()->route('employees')->with($notification);
    }

    public function delete($id)
    {
        $employee=Employee::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('employee_id',$id)->onlyTrashed()->first();

        $employee->forceDelete();
        $profile->forceDelete();

        $notification = array(
            'message' => 'Employee Details are permanently deleted.',
            'alert-type' => 'error'
        );

        return redirect()->route('employees')->with($notification);
    }


}
