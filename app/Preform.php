<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preform extends Model
{
    protected $fillable =['box_id','no_bags','kg_per_bag','total_kg','no_preform','company','batch_id','preform_g','tot_preform','open'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
