<?php

namespace App\Http\Controllers;

use App\Account;
use App\Admin;
use App\Commission;
use App\Employee;
use App\Expenses;
use App\Pay;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pay_types = Payment::all();
        return view('admin.employees.payments.index', compact('pay_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $rules =array(
            'type'=>'required|unique:payments'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        Payment::create([
            'type'=>$request->type
        ]);

        $notification = array(
            'message' => 'New Payment Type created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('payments')->with($notification);
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
        //
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
        $this->validate($request,[
            'type'=>'required'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->type=$request->type;;

        $payment->save();

        $notification = array(
            'message' => 'Payment Type updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('payments')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pay_type = Payment::findOrFail($id);
        $pay_type->delete();

        $notification = array(
            'message' => 'Payment-Type deleted and the record is updated',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function settle()
    {
       /* $today = Carbon::today()->format('Y-m-d');

        $commission_today = Commission::where('created_at',$today)->get();

        if (!empty($commission_today)) {
            foreach ($commission_today as $commission) {
                $employee_id = $commission->employee_id;
                $commission_amount = $commission->commission;
                $salary_amount = $commission->salary_amount;
                $salary_total =$commission->salary_total;
//                $commission_amount = empty($commission_amount) ? 0 : $commission_amount;
//                $amount = $commission_amount + $salary_amount;

                $pay = Pay::where('employee_id', $employee_id)->where('status',0)->first();

                if (!empty($pay))
                {
                    //Update
                    Pay::where('employee_id', $employee_id)->where('status',0)->update(['amount'=>$salary_total]);
                }else
                {
                    //Create New
                    Pay::create([
                        'employee_id'=>$employee_id,
                        'amount'=>$salary_total,
                    ]);
                }

                //Update Employee Balance
                $new_balance = 0;
                $employee = Employee::where('id',$employee_id)->first();
                $old_balance = $employee->balance;
                $new_balance = $old_balance - $amount;
                $employee->balance = $new_balance;
                $employee->save();

            }



        }*/
        $pays = Pay::all();
        return view('admin.employees.settlement', compact('pays'));
    }

    public function pay($id, $balance, $cash_type, $employee_id)
    {
        $balances = $balance == 'NaN' ? 0 : $balance;
       $pay = Pay::where('id', $id)->where('status',0)->first();
        if (!empty($pay) ) {
            $amount = $pay->amount - $balances;
            $pay->amount = $balances;
            $pay->save();

        } else {
            //Create New
            Pay::create([
                'employee_id' => $employee_id,
                'amount' => $balances,
            ]);
        }



        $user_id = Admin::getUser(Session::get('adminSession'))->id;

       $employee = Employee::findOrFail($pay->employee_id);
       $expense = new Expenses();
        $expense->amount = $amount;
        $expense->user_id = $user_id;
        $expense->cash_type = $cash_type;
        $expense->description = 'Commission Settlement to '.$employee->name;
        $expense->save();

        $account = new Account;
        $account->employee_id = $employee->id;
        $account->balance = $balances;
        $account->amount = $amount;
        $account->user_id = $user_id;
        $account->cash_type = $cash_type;
        $account->description = 'Commission Settlement to '.$employee->name;
        $account->save();

        //Update Employee Balance
        $employee = Employee::where('id',$pay->employee_id)->first();
        $employee->balance = $balances;
        $employee->save();

        $notification = array(
            'message' => 'An Employee is successfully Paid',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
