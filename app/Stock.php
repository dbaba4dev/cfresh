<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['bag_id','preform','in_process','finished'];

    public function bag()
    {
        return $this->belongsTo(Bag::class);
    }
}
