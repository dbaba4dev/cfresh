<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['amount', 'user_id','description','type','employee_id','order_id','cash_type','inc_date'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function employee()
    {
            return $this->belongsTo(Employee::class);
    }
}
