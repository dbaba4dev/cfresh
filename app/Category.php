<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','payment_id','amount'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
