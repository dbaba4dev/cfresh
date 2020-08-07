<?php

namespace App\Http\Controllers;

use App\Box;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Box::all();
        return view('frontend.index')->with(compact('products'));
    }

    public function about_us()
    {
        return view('frontend.about.about_us');
    }

    public function faq()
    {
        return view('frontend.about.faq');
    }

    public function getFooter(Request $request)
    {
        $query = $request->all();
        return view('pdfFooter',compact('query'));
    }
}
