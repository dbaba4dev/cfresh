<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Batch;
use App\Batch_history;
use App\Cap;
use App\Damage;
use App\Expenses;
use App\Income;
use App\Label;
use App\Material;
use App\Preform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PDF;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        $materials = Material::all();
        return view('admin.stock.materials.index', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }
        $rules =array(
            'name'=>'required|unique:materials'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        Material::create([
            'name'=>$request->name
        ]);

        $notification = array(
            'message' => 'New Material Added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('materials')->with($notification);
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
        if(Session::has('adminSession'))
        {

        }else
        {
            return redirect()->route('admin.login')->with('flash_msg_error','Please login to access.');
        }

        $this->validate($request,[
            'name'=>'required'
        ]);

        $material = Material::findOrFail($id);

        $material->name=$request->name;

        $material->save();

        $notification = array(
            'message' => 'Material updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('materials')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        $notification = array(
            'message' => 'Material deleted from Stock',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function damages(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = $request->all();
//            dd($data);

            $user = Admin::where('username',Session::get('adminSession'))->first();

            $batch = !empty($data['batch']) ?  $data['batch'] : '';

            $cases = empty($data['cases']) ? 0 : $data['cases'];
            $preform = 0 ;   $cap =0;  $label = 0;
            $pre_batch = '' ;   $cap_batch ='';  $lbl_batch = '';

            if ($cases == '1')
            {
                $preform = 12*$data['quantity'];
                $cap = 12*$data['quantity'];
                $label = 12*$data['quantity'];

                $pre_batch = $data['pre_batch'];
                $cap_batch = $data['cap_batch'];
                $lbl_batch = $data['lbl_batch'];

             /*======================= PREFORM =================================================*/

                $batch_info_pre = Batch_history::where('batch_name',$pre_batch)->first();

                $preformDetails = Batch::where('name', $pre_batch)->first();
                $preform_avail = $preformDetails->preform->tot_preform;
                $preform_avail_bags = $preformDetails->preform->no_bags;

                if ($preform_avail_bags <=0) {
                    $notification = array(
                        'message' => 'Preform is not available in the stock. Please Charge in more preforms',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }
                $tot_price_pre = $batch_info_pre->amount;
                $tot_material_in_bag_pre = $batch_info_pre->no_materials;
                $each_price_pre =$tot_price_pre/$tot_material_in_bag_pre;

                if ($preform_avail < $preform) {
                    $notification = array(
                        'message' => 'Insufficient Preforms in the stock for this operation.',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                $material =!empty($cap_batch) ? (substr($cap_batch,0,3)) : '';
                $batch_info_cap =Batch_history::query()->orwhere('batch_name',  'like', '%' . $material . '%' )->first();

                $capDetails = Batch::where('name', $cap_batch)->first();
                $cap_avail = $capDetails->cap->tot_cap;
                $cap_avail_bags = $capDetails->cap->no_bags;

                if ($cap_avail_bags <=0) {
                    $notification = array(
                        'message' => 'Cap is not available in the stock. Please Charge in more caps',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                $tot_price_cap = $batch_info_cap->amount;
                $tot_material_in_bag_cap = $batch_info_cap->no_materials;
                $each_price_cap =$tot_price_cap/$tot_material_in_bag_cap;

                if ($cap_avail < $cap) {
                    $notification = array(
                        'message' => 'Insufficient Caps in the stock for this operation.',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                $batch_info_lbl = Batch_history::where('batch_name',$lbl_batch)->first();

                $labelDetails = Batch::where('name', $lbl_batch)->first();
                $label_avail = $labelDetails->label->tot_label;
                $label_avail_bags = $labelDetails->label->no_bags;

                if ($label_avail_bags <=0) {
                    $notification = array(
                        'message' => 'Label is not available in the stock. Please Charge in more labels',
                        'alert-type' => 'warning'
                    );

                    return redirect()->back()->with($notification);
                }

                $tot_price_lbl = $batch_info_lbl->amount;
                $tot_material_in_bag_lbl = $batch_info_pre->no_materials;
                $each_price_lbl =$tot_price_lbl/$tot_material_in_bag_lbl;

                if ($label_avail < $label) {
                    $notification = array(
                        'message' => 'Insufficient Labels in the stock for this operation.',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }

                //Total Amount in Naira
//                $tot_price_dam_mat = $preform*$each_price_pre + $cap*$each_price_cap + $label*$each_price_lbl;

                //Update Expenses Table with this price amount
//                $expenses = new Expenses();
//                $expenses->amount = $tot_price_dam_mat;
//                $expenses->description = 'amount lost due to damages';
//                $expenses->user_id = $user->id;
//                $expenses->type = 'C-fresh';
//                $expenses->cash_type = 'Lost';
//                $expenses->expense_date = today();
//                $expenses->employee = '';
//                $expenses->save();

//                dd($cap_batch);

                //Remove the Damage amount from the Stock Batch
                $preform_id = Material::getMaterialId($pre_batch)->preform_id;
                $preform_batch = Preform::where('id', $preform_id)->first();
                $old_total_mat = $preform_batch->tot_preform;
                $kg_per_bag = $preform_batch->kg_per_bag;
                $material_g = $preform_batch->preform_g;

                $new_tot_material = $old_total_mat - $preform;
                $new_total_kg = $new_tot_material * $material_g/1000;
                $new_no_bag = $new_total_kg/$kg_per_bag;

//                dd($each_price_pre . ' '. $each_price_cap .  ' ' . $each_price_lbl);

                $damage = new Damage();
                $damage->batch = $pre_batch;
                $damage->admin_name = $user->employee->name;
                $damage->quantity = $preform;
                $damage->ops_date = today();
                $damage->amount = $preform*$each_price_pre;
                $damage->comment = $data['comment'];
                $damage->save();

                Preform::where('id', $preform_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_preform'=>$new_tot_material] );

                $cap_id = Material::getMaterialId($cap_batch)->cap_id;
                $caps_batch = Cap::where('id', $cap_id)->first();
                $old_total_mat = $caps_batch->tot_cap;
                $kg_per_bag = $caps_batch->kg_per_bag;
                $material_g = $caps_batch->cap_g;

                $new_tot_material = $old_total_mat - $cap;
                $new_total_kg = $new_tot_material * $material_g/1000;
                $new_no_bag = $new_total_kg/$kg_per_bag;

                $damage = new Damage();
                $damage->batch = $cap_batch;
                $damage->admin_name = $user->employee->name;
                $damage->quantity = $cap;
                $damage->amount = $cap*$each_price_cap;
                $damage->ops_date = today();
                $damage->comment = $data['comment'];
                $damage->save();

                Cap::where('id', $cap_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_cap'=>$new_tot_material] );

                $label_id = Material::getMaterialId($lbl_batch)->label_id;
                $label_batch = Label::where('id', $label_id)->first();
                $old_total_mat = $label_batch->tot_label;
                $kg_per_bag = $label_batch->kg_per_bag;
                $material_g = $label_batch->label_g;

                $new_tot_material = $old_total_mat - $label;
                $new_total_kg = $new_tot_material * $material_g/1000;
                $new_no_bag = $new_total_kg/$kg_per_bag;

                $damage = new Damage();
                $damage->batch = $lbl_batch;
                $damage->admin_name = $user->employee->name;
                $damage->quantity = $label;
                $damage->amount = $label*$each_price_lbl;
                $damage->ops_date = today();
                $damage->comment = $data['comment'];
                $damage->save();

                Label::where('id', $label_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_label'=>$new_tot_material] );

                $notification = array(
                    'message' => 'Record updated successfully!!',
                    'alert-type' => 'success'
                );
                return redirect()->route('damages')->with($notification);

            }else
            {
                $material = (substr($batch,0,3));

                $batch_info = Batch_history::where('batch_name',$batch)->first();
                $tot_price = $batch_info->amount;
                $tot_material_in_bag = $batch_info->no_materials;
                $each_price =$tot_price/$tot_material_in_bag;

                $materialDetails = Batch::where('name', $batch)->first();

                //preform
                if (!empty($materialDetails->preform)){
                    $avail = $materialDetails->preform->tot_preform;

                    if ($avail < $data['quantity']) {
                        $notification = array(
                            'message' => 'Insufficient Preforms in the stock for this operation.',
                            'alert-type' => 'error'
                        );

                        return redirect()->back()->with($notification);
                    }
                }

                //cap
                if (!empty($materialDetails->cap)){
                    $avail = $materialDetails->cap->tot_cap;

                    if ($avail < $data['quantity']) {
                        $notification = array(
                            'message' => 'Insufficient Caps in the stock for this operation.',
                            'alert-type' => 'error'
                        );

                        return redirect()->back()->with($notification);
                    }
                }

                //label
                if (!empty($materialDetails->label)){
                    $avail = $materialDetails->label->tot_label;

                    if ($avail < $data['quantity']) {
                        $notification = array(
                            'message' => 'Insufficient Labels in the stock for this operation.',
                            'alert-type' => 'error'
                        );

                        return redirect()->back()->with($notification);
                    }
                }


                //Update Expenses Table with this price amount
//                $expenses = new Expenses();
//                $expenses->amount = $data['quantity']*$each_price;
//                $expenses->description = 'amount lost due to damages';
//                $expenses->user_id = $user->id;
//                $expenses->type = 'C-fresh';
//                $expenses->cash_type = 'Lost';
//                $expenses->expense_date = today();
//                $expenses->employee = '';
//                $expenses->save();

                $damage = new Damage();
                $damage->batch = $batch;
                $damage->admin_name = $user->employee->name;
                $damage->quantity = $data['quantity'];
                $damage->amount = $data['quantity']*$each_price;
                $damage->comment = $data['comment'];
                $damage->save();


                if ($material == 'PRE')
                {

                    //Remove the Damage amount from the Stock Batch
                    $preform_id = Material::getMaterialId($batch)->preform_id;
                    $preform_batch = Preform::where('id', $preform_id)->first();
                    $old_total_mat = $preform_batch->tot_preform;
                    $kg_per_bag = $preform_batch->kg_per_bag;
                    $material_g = $preform_batch->preform_g;

                    $new_tot_material = $old_total_mat - $data['quantity'];
                    $new_total_kg = $new_tot_material * $material_g/1000;
                    $new_no_bag = $new_total_kg/$kg_per_bag;

                    Preform::where('id', $preform_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_preform'=>$new_tot_material] );

                    $notification = array(
                        'message' => 'Record updated successfully!!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('damages')->with($notification);
                }elseif ($material == 'CAP')
                {
//                    $cap = $cap == 0 ? $data['quantity'] : $cap;
//                    $cap_batch = $cap_batch == 0 ? $batch : $cap_batch;

//                    $damage = new Damage();
//                    $damage->batch = $batch;
//                    $damage->admin_name = $user->employee->name;
//                    $damage->quantity = $data['quantity'];
//                    $damage->amount = $preform*$each_price_pre;
//                    $damage->ops_date = today();
//                    $damage->comment = $data['comment'];
//                    $damage->save();

                    //Remove the Damage amount from the Stock Batch
                    $cap_id = Material::getMaterialId($batch)->cap_id;
                    $cap_batch = Cap::where('id', $cap_id)->first();
                    $old_total_mat = $cap_batch->tot_cap;
                    $kg_per_bag = $cap_batch->kg_per_bag;
                    $material_g = $cap_batch->cap_g;

                    $new_tot_material = $old_total_mat - $data['quantity'];
                    $new_total_kg = $new_tot_material * $material_g/1000;
                    $new_no_bag = $new_total_kg/$kg_per_bag;

                    Cap::where('id', $cap_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_cap'=>$new_tot_material] );

                    $notification = array(
                        'message' => 'Record updated successfully!!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('damages')->with($notification);
                }elseif ($material == 'LBL' )
                {

//                    $damage = new Damage();
//                    $damage->batch = $batch;
//                    $damage->admin_name = $user->employee->name;
//                    $damage->quantity = $data['quantity'];
//                    $damage->amount = $preform*$each_price_pre;
//                    $damage->ops_date = today();
//                    $damage->comment = $data['comment'];
//                    $damage->save();

                    //Remove the Damage amount from the Stock Batch
                    $label_id = Material::getMaterialId($batch)->label_id;
                    $label_batch = Label::where('id', $label_id)->first();
                    $old_total_mat = $label_batch->tot_label;
                    $kg_per_bag = $label_batch->kg_per_bag;
                    $material_g = $label_batch->label_g;

                    $new_tot_material = $old_total_mat - $data['quantity'];
                    $new_total_kg = $new_tot_material * $material_g/1000;
                    $new_no_bag = $new_total_kg/$kg_per_bag;

                    Label::where('id', $label_id)->update(['no_bags'=>$new_no_bag,'total_kg'=>$new_total_kg,'tot_label'=>$new_tot_material] );

                    $notification = array(
                        'message' => 'Record updated successfully!!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('damages')->with($notification);
                }
            }
        }

        $batch_pres = Batch::with('preform')->where('preform_id','!=',0)->get();
        $batch_caps = Batch::with('cap')->where('cap_id','!=',0)->get();
        $batch_lbls = Batch::with('label')->where('label_id','!=',0)->get();
        $batchs = Batch::all();
//        foreach ($batchs as $batch) {
//            dd($batch->preform->no_bags);
//        }
//        $batchs = json_decode(json_encode($batchs));
//        echo '<pre>'; print_r($batchs); die();
//        dd($batch_pres);
        return view('admin.products.damages', compact('batchs','batch_pres','batch_caps', 'batch_lbls'));
    }

    public function view_damages(Request $request)
    {
        $method = $request->method();
        if ($request->isMethod('post'))
        {
            $from = $request->input('from');
            $to   = $request->input('to');
            if ($request->has('search'))
            {
                // select search
                $search = DB::select("SELECT * FROM damages WHERE created_at BETWEEN '$from' AND '$to'");
                return view('admin.products.view_damages',['damages' => $search]);
            }elseif ($request->has('exportPDF'))
            {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM damages WHERE created_at BETWEEN '$from' AND '$to'");
                $total_amount =  array_sum(array_column($PDFReport, 'amount'));
                $pdf = PDF::loadView('admin.products.damages_pdfview', ['PDFReport' => $PDFReport, 'from'=>$from, 'to'=>$to,
                    'total_amount'=>$total_amount])->setPaper('a4', 'portrait');
                return $pdf->download('damages-report.pdf');
            }
        }
        else
        {
            //select all
            $damages = Damage::all();
            return view('admin.products.view_damages', compact('damages'));
        }
    }

    public function pdf_damages_view()
    {
        $pdfView = DB::select('SELECT * FROM damages');
        $pdf = PDF::loadView('admin.products.damages_pdfview', ['pdfViews'=> $pdfView])
            ->setPaper('a4','landscape');
        return $pdf->download('report.pdf');
    }
}
