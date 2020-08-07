<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    protected $fillable = ['name','discount'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
