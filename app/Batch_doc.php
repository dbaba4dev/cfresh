<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch_doc extends Model
{
    protected $fillable = ['batch_id','doc_path','name'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public static function getDocs($batch_id)
    {
        $getDocs = Batch_doc::where('batch_id',$batch_id)->get();
        return $getDocs;
    }
}
