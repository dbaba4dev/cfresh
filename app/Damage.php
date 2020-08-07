<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    protected $fillable = ['batch_id', 'user_id', 'quantity','amount', 'comment','ops_date'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

}
