<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemAccount extends Model
{
    protected $fillable = [
        'amount',
        'expense',
        'balance',
        'description',
        'employee',
        'user'
    ];
}
