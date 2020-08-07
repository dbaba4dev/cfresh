<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processlabel extends Model
{
    protected $fillable = ['no_bags','kg_bags','no_label','preform_damages','label_g','box_id','is_open'];
}
