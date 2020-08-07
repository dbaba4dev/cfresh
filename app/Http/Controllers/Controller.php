<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function mainCategories()
    {
        $mainCategories = Box::all();
//        $mainCategories = json_decode(json_encode($mainCategories));
//        echo '<pre>'; print_r($mainCategories); die();
        return $mainCategories;
    }

}
