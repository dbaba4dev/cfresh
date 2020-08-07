<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = ['amount', 'user_id','description', 'doc','type','employee','cash_type','expense_date','order_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
