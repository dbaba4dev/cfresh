<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processpreforms_summary extends Model
{
    protected $fillable = ['box_id','no_preform','no_cap','no_label'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
