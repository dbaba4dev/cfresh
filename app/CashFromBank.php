<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashFromBank extends Model
{
    protected $fillable = ['amount','admin_id','balance','bank','account_name','account_no','description'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
