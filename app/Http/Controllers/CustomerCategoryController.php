<?php

namespace App\Http\Controllers;

use App\CustomerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CustomerCategory::all();
        return view('admin.customers.categories.index', compact('categories'));
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
//        $this->validate($request,[
//            'name'=>'required|unique:customer_categories'
//        ]);

        $rules =array(
            'name'=>'required|unique:customer_categories'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        CustomerCategory::create([
            'name'=>$request->name,
            'discount'=>$request->discount,
        ]);

        $notification = array(
            'message' => 'Customer Category created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers.categories')->with($notification);
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
        $category = CustomerCategory::findOrFail($id);
        return view('admin.customers.categories.edit', compact('category'));
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
//        dd($request->all());
        $this->validate($request,[
            'name'=>'required'
        ]);

        $category = CustomerCategory::findOrFail($id);

        $category->name=$request->name;
        $category->discount=$request->edit_discount;

        $category->save();

        $notification = array(
            'message' => 'Category updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers.categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CustomerCategory::findOrFail($id);
        $category->delete();

        $notification = array(
            'message' => 'Category deleted!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
