<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin','status', 'old_balance','religion','dob', 'gender', 'pincode','religion','company_name', 'coupon_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }

    public static function getUsersOldBalanace($user_id)
    {
        $getUsersOldBalanace = User::where('id',$user_id)->first();
        return $getUsersOldBalanace->old_balance;
    }

//    public static function UpdateUsersOldBalanace($user_id, $balance)
//    {
//        $new_balance = 0;
//        $getUsersOldBalanace = User::where('id',$user_id)->first();
//        $new_balance = $getUsersOldBalanace->old_balance - $balance;
//        $getUsersOldBalanace->old_balance = $new_balance;
//        $getUsersOldBalanace->save();
//    }
}
