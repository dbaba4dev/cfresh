<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processcap extends Model
{
    protected $fillable = ['no_bags','kg_bags','no_cap','preform_damages','cap_g','box_id','is_open'];
}
