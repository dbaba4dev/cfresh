<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = ['no_bags','kg_per_bag','total_kg','no_label','box_id','company','batch_id','label_g','tot_label','open'];

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
