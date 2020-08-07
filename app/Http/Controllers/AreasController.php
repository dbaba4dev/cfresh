<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreasController extends Controller
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
        $areas = Area::all();
        return view('admin.customers.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.customers.areas.create');
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

//        $this->validate($request,[
//            'name'=>'required|unique:areas'
//        ]);

        $rules =array(
            'name'=>'required|unique:areas'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        Area::create([
            'name'=>$request->name
        ]);

        $notification = array(
            'message' => 'New Location created!',
            'alert-type' => 'success'
        );

//        dd($request->all());

        return redirect()->route('areas')->with($notification);
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
        $area = Area::findOrFail($id);
        return view('admin.customers.areas.edit', compact('area'));
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
        $this->validate($request,[
            'name'=>'required'
        ]);

        $area = Area::findOrFail($id);

        $area->name=$request->name;

        $area->save();

        $notification = array(
            'message' => 'Customer location updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('areas')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        $notification = array(
            'message' => 'Customer location deleted!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
