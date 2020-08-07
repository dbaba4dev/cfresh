<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processpreform extends Model
{
    protected $fillable = ['no_bags','kg_bags','no_preform','preform_damages','preform_g','box_id','is_open'];

}
