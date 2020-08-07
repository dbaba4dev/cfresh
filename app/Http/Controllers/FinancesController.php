<?php

namespace App\Http\Controllers;

use App\Account;
use App\Admin;
use App\Bank;
use App\CashBalance;
use App\CashFromBank;
use App\CashToBank;
use App\Customer;
use App\Employee;
use App\Expenses;
use App\Http\Requests\AddCashFromBankRequest;
use App\Http\Requests\AddCreditRequest;
use App\Income;
use App\Order;
use App\Pay;
use App\Product;
use App\TemAccount;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use PDF;

class FinancesController extends Controller
{
    public function income(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $admin = Admin::with('employee')->where('username',Session::get('adminSession'))->first();
//            $user_id = Admin::getUser(Session::get('adminSession'))->id;
//            dd($admin->id);
            $user = Admin::where('id',$admin->id)->first();
            $user_name = $user->employee->name;
            $cash_type = empty($data['cash_type']) ? '' : $data['cash_type'];
            $customer = !empty($data['customer']) ? $data['customer'] : null;
            $amount = (float) str_replace(',', '', $data['amount']);

            //If Customer Paid a due for a credit collected get
            //1- get the customer detail in the income table
            //1- Update Customer Table
            if (!empty($customer)){
                $customerDetail = User::where('id',$customer)->first();
                $old_balance = !empty($customerDetail) ? $customerDetail->old_balance : 0;
                $new_balance = $old_balance - $amount;
                User::where('id',$customer)->update(['old_balance'=>$new_balance]);

                $order = new Order;
                $order->user_id = $customerDetail->id;
                $order->user_email= $customerDetail->email;
                $order->name= $customerDetail->name;
                $order->address= $customerDetail->address;
                $order->state= $customerDetail->state->name;
                $order->lga= $customerDetail->lga->name;
                $order->mobile= $customerDetail->mobile;
                $order->balance= $new_balance;
                $order->amount_paid= $amount;
                $order->coupon_code= '';
                $order->coupon_amount= 0;
                $order->order_status= "Settlement";
                $order->employee_id= $data['collector'];
                $order-> admin_id=$admin->id;
                $order->payment_method= '';
                $order->grand_total= $new_balance;
                $order->save();
            }




            if ($data['type']=='C-fresh' && empty($data['cash_type']))
            {
                $notification = array(
                    'message' => 'Please specify the Cash type (Wired or Cash)',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

            if ($data['type']=='Others')
            {
                $account=TemAccount::where('id',1)->first();
                $oldAmount =!empty($account) ? $account->amount : 0;
                $oldBalance =!empty($account) ? $account->balance : 0;
                $newAmount = $oldAmount + $amount;
//               $balance =!empty($account) ? $account->balance+$data['amount'] : $data['amount'];

                TemAccount::where('id',1)->update(['amount'=>$newAmount, 'balance'=>$oldBalance,'user'=>$user->employee->name]);

            }

            Income::create(['amount'=>$amount, 'description'=>$data['description'],'user_id'=>$admin->id,
                'type'=>$data['type'], 'cash_type'=>$cash_type, 'employee_id'=>$data['collector'], 'inc_date'=>today()]);

            $notification = array(
                'message' => 'Income Record added Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

        $employees = Employee::all();
        $customers = User::where('status', 1)->get();

        return view('admin.finances.add_finance', compact('employees', 'customers'));
    }

    public function expense(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            dd($data);
            $user_id = Admin::getUser(Session::get('adminSession'))->id;

            $expense_type = empty($data['expense_type']) ? '' : $data['expense_type'];
            $amount = (float) str_replace(',', '', $data['amount']);

            if ($data['type']=='C-fresh' && empty($data['expense_type']))
            {
                $notification = array(
                    'message' => 'Please specify the Cash type (Wired or Cash)',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

            if ($expense_type == 'Cash')
            {

            }

            $account=TemAccount::where('id',1)->first();

            if ($data['type']=='Others')
            {
                if (!empty($account))
                {
                    $old_balance = $account->balance;
                    $new_balance = $old_balance-$amount;
                    TemAccount::where('id',1)->update(['expense'=>$amount, 'balance'=>$new_balance]);
                }else
                {
                    $notification = array(
                        'message' => 'Amount deposited has been exhausted, call the CEO attention for assistance',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }

            }

            $expenses = new Expenses();
            $expenses->amount = $amount;
            $expenses->description = $data['description'];
            $expenses->user_id = $user_id;
            $expenses->type = $data['type'];
            $expenses->cash_type = $expense_type;
            $expenses->expense_date = today();
            $expenses->employee = $data['collector'];

            /*UPload File*/
            if ($request->hasFile('image'))
            {
                if (!is_dir(public_path('/images/backends_images/receipts/expenses')))
                {
                    mkdir(public_path('images/backends_images/receipts/expenses'), '0755',true);
                }

                $img_tmp = $request->file('image');
                if ($img_tmp->isValid()){
                    $baseName = $img_tmp->getClientOriginalName();
                    $original_name = time().'.'.$baseName;

                    $img_tmp->move(public_path('/images/backends_images/receipts/expenses'),  $original_name);

                    //Store Images in table
                    $expenses->doc = '/images/backends_images/receipts/expenses/'.$original_name;
                }else
                {
                    echo 'Not valid'; die();
                }
            }
            $expenses->save();

            $notification = array(
                'message' => 'Expense Record added Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $employees = Employee::all();
        return view('admin.finances.add_finance', compact('employees'));
    }



    public function viewIncomePage(Request $request)
    {
        $method = $request->method();
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
                $search = DB::select("SELECT * FROM incomes WHERE created_at BETWEEN '$from' AND '$to' AND amount > 0");
                return view('admin.finances.index',['ViewsPage' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM incomes WHERE created_at BETWEEN '$from' AND '$to' AND amount > 0");
                $total_amount =  array_sum(array_column($PDFReport, 'amount'));
                $pdf = PDF::loadView('admin.finances.pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount])->setPaper('a4', 'portrait');
                return $pdf->download('income-report.pdf');
            }
        }
        else
        {
            //select all
            $ViewsPage = Income::with('employee')->where('amount','>',0)->get();
//            dd($ViewsPage);
//            $ViewsPage = json_decode(json_encode($ViewsPage));
//            echo '<pre>'; print_r($ViewsPage); die();
            return view('admin.finances.index',['ViewsPage' => $ViewsPage]);
        }
    }

    public function pdf_income_view()
    {
        $pdfView = DB::select('SELECT * FROM incomes');
        $pdf = PDF::loadView('admin.finances.pdfview', ['pdfViews'=> $pdfView])
            ->setPaper('a4','landscape');
        return $pdf->download('report.pdf');
    }

    public function viewExpensePage(Request $request)
    {
        $method = $request->method();
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
                $search = DB::select("SELECT * FROM expenses WHERE created_at BETWEEN '$from' AND '$to'");
                return view('admin.finances.expense',['ViewsPage' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM expenses WHERE created_at BETWEEN '$from' AND '$to'");
                $total_amount =  array_sum(array_column($PDFReport, 'amount'));
                $pdf = PDF::loadView('admin.finances.expense_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount])->setPaper('a4', 'landscape');
                return $pdf->download('expenses-report.pdf');
            }
        }
        else
        {
            //select all
            $ViewsPage = DB::select('SELECT * FROM expenses');
            return view('admin.finances.expense',['ViewsPage' => $ViewsPage]);
        }
    }

    public function pdf_expenses_view()
    {
        $pdfView = DB::select('SELECT * FROM expenses');
        $pdf = PDF::loadView('admin.finances.expenses_pdfview', ['pdfViews'=> $pdfView])
            ->setPaper('a4','landscape');
        return $pdf->download('report.pdf');
    }

    public function checkBalanace(Request $request)
    {
        $income_amount = empty(Income::where('cash_type','cash')->where('inc_date',today())) ? 0 :
            Income::where('cash_type','cash')->where('inc_date',today())->sum('amount');
        $sales_amount = empty(Order::where('payment_method', 'Cash On Delivery')->where('trans_date',today())) ? 0 :
            Order::where('payment_method', 'Cash On Delivery')->where('trans_date',today())->sum('amount_paid');
        $total_income = $income_amount + $sales_amount;

        $expenses = empty(Expenses::where('cash_type','cash')->where('expense_date',today())) ? 0 :
            Expenses::where('cash_type','cash')->where('expense_date',today())->sum('amount');

        $balance = $total_income - $expenses;

        if ($total_income > 0)
        {
            $cash_flow = CashBalance::where('cash_date',today())->first();
            if (!empty($cash_flow))
            {
                //Update
                CashBalance::where('cash_date',today())->update(['daily_income'=>$total_income, 'daily_expense'=>$expenses,
                    'balance'=>$balance]);
            }else
            {
                $cash_balance = CashBalance::where('cash_date', Carbon::yesterday())->first();
                $new_balance = !empty($cash_balance) ? $cash_balance->new_balance - $balance : $balance;
                //Create
                CashBalance::create([
                    'daily_income'=> $total_income,
                    'daily_expense'=> $expenses,
                    'balance'=> $balance,
                    'new_balance'=> $new_balance,
                    'cash_date'=> today()
                ]);
            }

        }else
        {
            $notification = array(
                'message' => 'Transaction has not been made today yet!!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if ($request->isMethod('post'))
        {
            $data = $request->all();
            CashBalance::where('id',$data['id'])->update(['question'=>$data['questions'],
                'description'=>$data['description'],'status'=>1]);
        }

        $cashBalances = CashBalance::all();
        return view('admin.finances.check_balance', compact('cashBalances'));
    }

    public function getCash2Bank(Request $request)
    {
        $bundle = CashToBank::all();
        $banks = Bank::all();
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                dd($request->all());
//                $search = DB::select("SELECT * FROM cash_from_banks WHERE created_at BETWEEN '$from' AND '$to'");
                $search =  CashToBank::with('admin')->whereBetween('created_at', [$from, $to])->get();
//                dd($search);
                return view('admin.finances.bank_cash',['bundle' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
//                $PDFReport = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $PDFReport = CashToBank::with('admin')->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $total_amount = array_sum(array_column($PDFReport, 'amount'));

                $pdf = PDF::loadView('admin.finances.cash_to_bank_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount])->setPaper('a4', 'landscape');
                return $pdf->download('Cash-to-bank-report.pdf');
            }
        }
        else
        {
            //select all
//            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.finances.bank_cash', compact('bundle','user', 'banks'));
        }

    }

    public function cash2Bank(Request $request)
    {
        $user = Admin::getUser(Session::get('adminSession'));
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $amount = (float) str_replace(',', '', $data['amount']);
            $bank = !empty($data['bank']) ? $data['bank'] : '';
            $account_name = !empty($data['account_name']) ? $data['account_name'] : '';
            $account_no = !empty($data['account_no']) ? $data['account_no'] : '';
            $account_no = (int) str_replace('-', '', $data['account_no']);
            $description = !empty($data['description']) ? $data['description'] : '';


            CashToBank::create([
                'amount'=>$amount,
                'user_id'=>$user->id,
                'bank'=>$bank,
                'account_name'=>$account_name,
                'account_no'=>$account_no,
                'description'=>$description,
                'move_date'=>today()
            ]);

            //Update Income Table
            $income = new Income();
            $income->amount = -$amount;
            $income->user_id = $user->id;
            $income->description = $description;
            $income->type = 'C-fresh';
            $income->employee_id = $user->employee->id;
            $income->cash_type ='Cash';
            $income->inc_date = today();
            $income->save();

            $notification = array(
                'message' => 'Record created successfully!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

//        $bundle = CashToBank::all();
//        $banks = Bank::all();
//        return view('admin.finances.bank_cash', compact('bundle','user', 'banks'));
    }

    public function teller(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $cash = CashToBank::where('id',$id)->first();
            /*UPload File*/
            if ($request->hasFile('teller'))
            {
                if (!is_dir(public_path('/images/backends_images/tellers')))
                {
                    File::makeDirectory('/images/backends_images/tellers', 0755, true);
//                    mkdir(public_path('images/backends_images/tellers'), '0755',true);

                }

                $img_tmp = $request->file('teller');
                if ($img_tmp->isValid()){
                    $baseName = $img_tmp->getClientOriginalName();
                    $original_name = time().'.'.$baseName;

                    $img_tmp->move(public_path('/images/backends_images/tellers'),  $original_name);

                    //Store Images in table
                    $cash->teller = '/images/backends_images/tellers/'.$original_name;
                }else
                {
                    echo 'Not valid'; die();
                }
            }
            $cash->save();

            $notification = array(
                'message' => 'Teller Saved Successfully!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function credit(AddCreditRequest $request)
    {

        $admin = Admin::with('employee')->where('username',Session::get('adminSession'))->first();
        $amount = (float) str_replace(',', '',  $request->amount);
        $employee_id = $request->collector;
        $credit_type = $request->credit_type;
        if (empty($credit_type)){
            $notification = array(
                'message' => 'Cash type must be selected!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        //Update employee Balance
        $employee = Employee::where('id',$employee_id)->first();
        $old_balance  =  $employee->balance;
        $new_balance = $old_balance - $amount;
        $employee->balance = $new_balance;
        $employee->save();

        //Update employee Account
        Account::create([
            'amount'=>$amount,
            'employee_id'=>$employee_id,
            'user_id'=>$admin->id,
            'balance'=>$new_balance,
            'cash_type'=>$credit_type,
            'description'=>'Credit'
        ]);

        //Update Pay amount
        $pay = Pay::where('employee_id',$employee_id)->where('status',0)->first();
        $pay->amount = $new_balance;
        $pay->save();

        //Update Expenses Table
        $expense = new Expenses();
        $expense->amount = $amount;
        $expense->user_id = $admin->id;
        $expense->employee = $employee->name;
        $expense->cash_type = $credit_type;
        $expense->expense_date = today();
        $expense->description = 'Credit ';
        $expense->save();

        $notification = array(
            'message' => 'Credit record saved!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function getcashFromBank(Request $request)
    {
        $bundle = CashFromBank::all();
        $banks = Bank::all();
        if ($request->isMethod('post'))
        {
            $from = Carbon::parse($request->input('from') . ' 01:00:00')->toDateTimeString();
            $to = Carbon::parse($request->input('to') . ' 23:59:00')->toDateTimeString();
            if ($request->has('search'))
            {
                // select search
//                dd($request->all());
//                $search = DB::select("SELECT * FROM cash_from_banks WHERE created_at BETWEEN '$from' AND '$to'");
                $search =  CashFromBank::with('admin')->whereBetween('created_at', [$from, $to])->get();
//                dd($search);
                return view('admin.finances.cash_from_bank',['bundle' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
//                $PDFReport = DB::select("SELECT * FROM orders WHERE created_at BETWEEN '$from' AND '$to'");
                $PDFReport = CashFromBank::with('admin')->whereBetween('created_at', [$from, $to])->get();
                $PDFReport = json_decode(json_encode($PDFReport));
                $total_amount = array_sum(array_column($PDFReport, 'amount'));

                $pdf = PDF::loadView('admin.finances.cash_from_bank_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount])->setPaper('a4', 'landscape');
                return $pdf->download('Cash-from-bank-report.pdf');
            }
        }
        else
        {
            //select all
//            $ViewsPage = Order::with('orders')->where('user_id',$id)->get();
            return view('admin.finances.cash_from_bank', compact('bundle','banks'));
        }


    }

    public function cashFromBank(AddCashFromBankRequest $request)
    {
        $admin = Admin::with('employee')->where('username',Session::get('adminSession'))->first();
        if ($request->isMethod('post'))
        {
            $data = $request->all();
            $amount = (float) str_replace(',', '', $data['amount']);
            $bank = !empty($data['bank']) ? $data['bank'] : '';
            $account_name = !empty($data['account_name']) ? $data['account_name'] : '';
//            $account_no = !empty($data['account_no']) ? $data['account_no'] : '';
            $account_no = (int) str_replace('-', '', $data['account_no']);
            $description = !empty($data['description']) ? $data['description'] : '';


            CashFromBank::create([
                'amount'=>$amount,
                'admin_id'=>$admin->id,
                'bank'=>$bank,
                'account_name'=>$account_name,
                'account_no'=>$account_no,
                'balance'=>$amount,
                'description'=>$description
            ]);

            $notification = array(
                'message' => 'Record created successfully!!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }


    }
}















