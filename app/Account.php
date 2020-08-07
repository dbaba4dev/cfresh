<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['employee_id', 'user_id','amount', 'balance', 'cash_type','description'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class,'user_id');
    }
}
