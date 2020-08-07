<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable =['name','preform_id','cap_id','label_id','comment','amount'];

    public function preform()
    {
        return $this->belongsTo(Preform::class);
    }

    public function cap()
    {
        return $this->belongsTo(Cap::class);
    }

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}

