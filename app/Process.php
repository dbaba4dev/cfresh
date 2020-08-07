<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $fillable =['processpreform_id','processcap_id','processlabel_id','is_open'];

    public function preform()
    {
        return $this->belongsTo(Processpreform::class);
    }

    public function cap()
    {
        return $this->belongsTo(Processcap::class);
    }

    public function label()
    {
        return $this->belongsTo(Processlabel::class);
    }
}
