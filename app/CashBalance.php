<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBalance extends Model
{
    protected $fillable = [
        'daily_income',
        'daily_expense',
        'balance',
        'cash_date',
        'description',
        'status',
        'new_balance',
        'question'
    ];
}
