<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    protected $fillable = ['product_id','quantity','box_id','employee_id','flow','balance'];

    public function box()
    {
        return $this->belongsTo(Box::class)->latest();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function updateRemainingStore($qty, $case_id, $employee=0)
    {
        $productStock = DB::table('stores')->where('box_id',$case_id)->orderBy('id', 'DESC')->first();

        //Update Stock
        $new_stock = $productStock->balance - $qty;
        $out_flow = new Store();
        $out_flow->quantity = $qty;
        $out_flow->box_id = $case_id;
        $out_flow->employee_id = $employee;
        $out_flow->flow = 'Out flow';
        $out_flow->balance = $new_stock;
        $out_flow->save();
    }

    public static function updateReturningStore($qty, $case_id, $employee=0)
    {
        $productStock = DB::table('stores')->where('box_id',$case_id)->orderBy('id', 'DESC')->first();

        //Update Stock
        $new_stock = $productStock->balance + $qty;
        $out_flow = new Store();
        $out_flow->quantity = $qty;
        $out_flow->box_id = $case_id;
        $out_flow->employee_id = $employee;
        $out_flow->flow = 'Returned';
        $out_flow->balance = $new_stock;
        $out_flow->save();
    }

    public static function OrderCancelled($order_id)
    {
        $order_detail = Order::where('id',$order_id)->first();
        $grand_total = $order_detail->grand_total;
        $diff = $grand_total - $order_detail->amount_paid;
        $old_balance = $order_detail->balance;
        $new_balance = $old_balance - $diff;
        $order_detail->order_status = 'Cancelled';
        $order_detail->amount_paid = 0;
        $order_detail->balance = $new_balance;
        $order_detail->save();


    }
}
