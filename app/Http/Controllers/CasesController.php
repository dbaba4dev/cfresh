<?php

namespace App\Http\Controllers;

use App\Box;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CasesController extends Controller
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
        $cases = Box::all();
        return view('admin.products.cases.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cases = Box::all();
        $materials = Material::all();
        return view('admin.products.cases.create', compact('cases','materials'));
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
        $this->validate($request, [
            'case'=>'required|unique:boxes',
            'preform_g'=>'required'
        ]);

        $cap_g = !empty($request->cap_g) ? $request->cap_g : 0;
        $label_g = !empty($request->label_g) ? $request->label_g : 0;
        $cap_no = !empty($request->cap_no) ? $request->cap_no : 0;
        $label_no = !empty($request->label_no) ? $request->label_no : 0;
        $price = !empty($request->price) ? $request->price : 0;
        $description = !empty($request->description) ? $request->description : '';

        if ($request->cap_chk == 'pieces')
        {
            $cap_g = 0;
        }else{
            $cap_no = 0;
        }

        if ($request->label_chk == 'pieces')
        {
            $label_g = 0;
        }else{
            $label_no = 0;
        }

        $product = new Box();
        $product->case = $request->case;
        $product->preform_g = $request->preform_g;
        $product->cap_g = $cap_g;
        $product->label_g = $label_g;
        $product->cap_no = $cap_no;
        $product->label_no = $label_no;
        $product->price = $price;
        $product->description = $description;

        /*UPload File*/
        if ($request->hasFile('image'))
        {
            $img_tmp = $request->file('image');
            if ($img_tmp->isValid()){

                $extension = $img_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $image_path = 'images/backends_images/products/'.$filename;

                //Resize images
                Image::make($img_tmp)->resize(300,300)->save($image_path);

                //Store Images name in products table
                $product->image = $filename;
            }else
            {
                echo 'Not valid'; die();
            }
        }

        $product->save();


        $notification = array(
            'message' => 'New Product Case Added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('cases')->with($notification);
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
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            echo '<pre>'; print_r($data); die();
            $filename='';
            if ($request->hasFile('image'))
            {
                $img_tmp = $request->file('image');
                if ($img_tmp->isValid()){

                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/backends_images/products/'.$filename;

                    //Resize images
                    Image::make($img_tmp)->resize(300,300)->save($image_path);

                }else
                {
                    $filename = $data['current_image'];
                }
            }

            $cap_g = !empty($data['cap_g']) ? $data['cap_g'] : 0;
            $cap_no = !empty($data['cap_no']) ? $data['cap_no'] : 0;
            $label_g = !empty($data['label_g']) ? $data['label_g'] : 0;
            $label_no = !empty($data['label_no']) ? $data['label_no'] : 0;

            Box::where(['id'=>$id])->update(['case'=>$data['case'], 'price'=>$data['price'],
                'preform_g'=>$data['preform_g'],'cap_g'=>$cap_g,'cap_no'=>$cap_no, 'description'=>$data['description'],
                'label_g'=>$label_g, 'label_no'=>$label_no, 'image'=>$filename]);
            $notification = array(
                'message' => 'Product Case Updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('cases')->with($notification);
        }
        $product = Box::findOrFail($id);
//        $cases = Box::all();

        return view('admin.products.cases.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
//    public function update(Request $request, $id)
//    {
//        $this->validate($request,[
//            'name'=>'required',
//            'preform_g'=>'required'
//        ]);
//
//        if ($request->isMethod('post')) {
//            $data = $request->all();
//            $filename = '';
//            if ($request->hasFile('image')) {
//                $img_tmp = $request->file('image');
//                if ($img_tmp->isValid()) {
//
//                    $extension = $img_tmp->getClientOriginalExtension();
//                    $filename = rand(111, 99999) . '.' . $extension;
//                    $image_path = 'images/backends_images/products/' . $filename;
//
//                    //Resize images
////                    Image::make($img_tmp)->save($large_image_path);
////                    Image::make($img_tmp)->resize(600,600)->save($medium_image_path);
//                    Image::make($img_tmp)->resize(300, 300)->save($image_path);
//
//                } else {
//                    $filename = $data['current_image'];
//                }
//            }
//
//            Product::where(['id' => $id])->update(['category_id' => $data['category_id'], 'product_name' => $data['product_name'],
//                'product_code' => $data['product_code'], 'product_color' => $data['product_color'], 'description' => $data['description'],
//                'price' => $data['price'], 'image' => $filename]);
//        }
//
//        $material = Box::findOrFail($id);
//
//        $material->name=$request->name;
//        $material->preform_g=$request->preform_g;
//        $material->cap_g=$request->cap_g;
//        $material->label_g=$request->label_g;
//        $material->cap_no=$request->cap_no;
//        $material->label_no=$request->label_no;
//
//        $material->save();
//
//        $notification = array(
//            'message' => 'Case Record updated!',
//            'alert-type' => 'success'
//        );
//
//        return redirect()->route('cases')->with($notification);
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $case = Box::findOrFail($id);
        $case->delete();

        $notification = array(
            'message' => 'Case deleted',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteProductImage($id)
    {
        Box::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_msg_success','Product Image has been deleted Successfully!');
    }
}
