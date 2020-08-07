<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashToBank extends Model
{
    protected $fillable = ['amount','user_id','teller','move_date','bank','account_name','account_no','description'];
	
	public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
