<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch_history extends Model
{
    protected $fillable = [
        'batch_id','batch_name','amount', 'material','no_bags','kg_per_bags','total_kg', 'unit_g',
        'tot_preform','no_preform', 'company'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function docs()
    {
        return $this->belongsTo(Batch_doc::class);
    }
}
