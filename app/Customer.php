<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'credit_limit', 'employee_id', 'area_id', 'balance','customer_category_id','area_id','nick_name','company'];

    protected $dates = ['deleted_at'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function category()
    {
        return $this->belongsTo(CustomerCategory::class,'customer_category_id');
    }



}
