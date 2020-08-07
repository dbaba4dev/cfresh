<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name'];

    public static function getMaterialId($batch)
    {
        $getMaterialId = Batch::where('name', $batch)->first();
        return $getMaterialId;
    }

    public function getMaterialAttribute()
    {
        $batch = $this->batch;
        $first_three_cha = (substr($batch,0,3));
        if ($first_three_cha == 'PRE'){
            return 'Preforms';
        }
        if ($first_three_cha == 'CAP'){
            return 'Caps';
        }
        if ($first_three_cha == 'LBL'){
            return 'Labels';
        }
    }


}
