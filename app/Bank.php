<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name'];

    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }


}
