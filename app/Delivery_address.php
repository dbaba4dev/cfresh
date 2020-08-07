<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_address extends Model
{
    protected $fillable = ['user_id','user_email','name','address','city','state','pincode','mobile','addition_info'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
}
