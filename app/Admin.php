<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['username', 'password','status','employee_id','operation_access'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function getUser($username)
    {
        $getUser = Admin::where('username', $username)->first();
        return $getUser;
    }
}
