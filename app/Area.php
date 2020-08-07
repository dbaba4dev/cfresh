<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
