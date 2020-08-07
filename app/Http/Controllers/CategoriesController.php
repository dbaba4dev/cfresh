<?php

namespace App\Http\Controllers;

use App\Category;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $pay_types = Payment::all();
        return view('admin.employees.categories.index', compact('categories','pay_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $rules =array(
            'name'=>'required|unique:categories'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }
        $amount = (float) str_replace(',', '', $request->amount);

        Category::create([
            'name'=>$request->name,
            'payment_id'=>$request->payment_id,
            'amount'=>$amount
        ]);

        $notification = array(
            'message' => 'Employee Category created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.employees.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $amount = (float) str_replace(',', '', $request->amount);
        $this->validate($request,[
            'name'=>'required'
        ]);

        $category = Category::findOrFail($id);

        $category->name=$request->name;
        $category->payment_id=$request->payment_id;
        $category->amount=$amount;

        $category->save();

        $notification = array(
            'message' => 'Category updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = array(
            'message' => 'Category deleted!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
