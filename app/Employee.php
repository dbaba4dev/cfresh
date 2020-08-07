<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id','bank_id','payment_id', 'name','balance','joined','account_no','account_name','target','factor'];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

//    public static function getEmployeePaymentType($em)
//    {
//
//    }
//
//    public function orders()
//    {
//        return $this->hasMany(Order::class);
//    }
//

//
//    public function truck()
//    {
//        return $this->belongsTo(Truck::class);
//    }
//
//    public function expenses()
//    {
//        return $this->hasMany(Expense::class);
//    }

}
