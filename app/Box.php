<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable =['case','price','preform_g','cap_g','label_g','cap_no','label_no','description','image'];
}
