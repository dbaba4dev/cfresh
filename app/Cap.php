<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cap extends Model
{
    protected $fillable = ['no_bags','kg_per_bag','total_kg','no_cap','box_id','company','batch_id','cap_g','tot_cap','open'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
