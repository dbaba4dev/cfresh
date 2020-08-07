@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-book-open"></i> Inventory </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Inventory </i> </a> - </li>
                    <li class="active"> Stock</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="col-md-12">
{{--               @include('admin.includes.alert-msg')--}}
               <div class="card">
                   <div class="card-header bg-gradient-info">
{{--                       <span class="icon"><i class=""></i></span>--}}
                       <h5 class="card-title">New Material - <strong>Batch</strong></h5>
                   </div>
{{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                   <form action="{{route('stocks')}}" method="post">
                       @csrf
{{--                       <input type="hidden" name="product_id" value="{{$product->id}}">--}}
                       <div class="card-body">
                           <div class="form-group row my-0" >
                               <label for="product_code" class="col-sm-1 col-form-label text-right">Batch Code</label>
                               <label for="product_name" id="post_name" class="col-sm-3 col-form-label text-center"><strong><span id="pos"></span>{{$Batch_name}}</strong></label>
                               <input type="hidden" name="batch_name" id="batch_name" value="{{$Batch_name}}">
                           </div>
                           <hr class="my-0">

                           <div class="form-group row my-0" >
{{--                               <div class="col-md-6">--}}
                                   <label for="material" class="col-sm-1 col-form-label text-right">Material</label>
                                   <div class="col-sm-2" style="margin-top: 0.3rem">
                                       <select name="material" id="material" class="form-control form-control-sm select2-blue" required>
                                           <option value="" selected disabled>Select Material</option>
                                           @foreach($materials as $material)
                                               <option value="{{$material->id}}">{{$material->name}}</option>
                                           @endforeach
                                       </select>
                                   </div>
{{--                               </div>--}}
                               <div class="col-sm-2"></div>
                                   <label for="material" class="col-sm-1 col-form-label text-right">Company</label>
                                   <div class="col-sm-4" style="margin-top: 0.3rem">
                                       <input type="text" name="company" id="company" class="form-control form-control-sm" placeholder="Company name" style=""/>
                                   </div>
{{--                               </div>--}}

                           </div>
                           <hr class="my-0">

                           <div class="form-group row my-0" style="margin-left: 0.1rem">
                               <label for="product_color" class="col-sm-1 col-form-label ">New Batch</label>
                               <div class="field_wrapper">
                                   <div style="margin-top: 0.3rem">
                                       <div class="row" style="margin-right: 0.3rem">
                                        <div class="col-sm-4">
                                            <input type="number" name="no_bags" id="no_bags" class="form-control form-control-sm" placeholder="No. of Bags" required/>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" name="kg_bags" id="kg_bags" class="form-control form-control-sm" placeholder="Weight per Bag (kg)" required/>
                                        </div>
{{--                                        <div class="col-sm-3"> <input type="number" name="preform_g" id="preform_g"  class="form-control form-control-sm" placeholder="Unit weight (g)" required/></div>--}}
                                       <div class="col-sm-3">
                                           <select name="case" id="case" class="form-control form-control-sm" required>
                                               <option value="" selected disabled>Case Type</option>
                                               @foreach($cases as $case)
                                                   <option value="{{$case->id}}">{{$case->case}}</option>
                                               @endforeach
                                           </select>
                                       </div>
{{--                                        <div class="col-sm-2"></div>--}}
                                       </div>
                                   </div>

                               </div>
                           </div>
                           <hr class="my-1">
                           <div class="form-group row my-0" >
                               <label for="comment" class="col-sm-1 col-form-label text-right">Comment</label>
                               <div class="col-sm-9" style="margin-left: -0.3rem">
                                   <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                               </div>
                           </div>
                           <hr class="my-1" >



                       </div>

                       <div class="card-footer">
                           <input type="submit" value="Add Attribute" class="btn btn-success">
                       </div>

                   </form>

               </div>
           </div>

           <div class="col-md-12">
               <div class="card">
                   <div class="card-header bg-gradient-info">
                       <h5 class="card-title">View Batches</h5>
                   </div>

                   <form action="{{route('admin.editBatch')}}" method="post" id="edit_batch_form">
                       @csrf
                   <div class="card-body">

{{--                           <input type="hidden" name="batch_id" id="batch_id">--}}
                           <div class="table-responsive">
                               <table id="view_batches" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                   <thead>
                                   <tr>
                                       <th>Batch Code</th>
                                       <th>Material</th>
                                       <th>Case</th>
                                       <th>No. Bags</th>
                                       <th>Weight per Bag (kg)</th>
{{--                                       <th>Total Weight (kg)</th>--}}
{{--                                       <th>Material unit weight (g)</th>--}}
                                       <th>Total Materials</th>
                                       <th>No. Material per Bag</th>
                                       <td hidden></td>
{{--                                       <th>Company</th>--}}
{{--                                       <th>Comment</th>--}}
                                       <td hidden></td>
                                       <td hidden></td>
                                       <th></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($batches  as $batch)
                                       <tr>
                                           <td>{{$batch->name}}</td>

                                           @if(!empty($batch->preform))
                                               <td>Preform</td>
                                               <input type="hidden" name="arr_case[]" class="form-control form-control-sm" value="{{$batch->preform->box->id}}">
                                               <td>{{$batch->preform->box->case}}</td>
                                               <td><input  type="number" name="arr_no_preform_bag[]"  class="no_bags_{{$batch->id}} form-control form-control-sm" value="{{$batch->preform->no_bags}}"></td>
                                               <td><input type="text" name="arr_kg_per_bag_pre[]" class="kg_per_bag_{{$batch->id}} form-control form-control-sm"  value="{{$batch->preform->kg_per_bag}}"></td>
                                               <td>{{$batch->preform->tot_preform}}</td>
                                               <td><input type="number" name="arr_no_preform[]" class="no_material_{{$batch->id}} form-control form-control-sm" readonly value="{{$batch->preform->no_preform}}"></td>
                                               <td hidden>{{$batch->preform->company}}</td>
                                           @endif
                                           @if(!empty($batch->cap))
                                               <td>Cap</td>
                                               <input type="hidden" name="arr_case[]" class="form-control form-control-sm" value="{{$batch->cap->box->id}}">
                                               <td>{{$batch->cap->box->case}}</td>
                                               <td><input type="number" name="arr_no_cap_bag[]" class="no_bags_{{$batch->id}} form-control form-control-sm" value="{{$batch->cap->no_bags}}"></td>
                                               <td><input type="text" name="arr_kg_per_bag_cap[]" class="kg_per_bag_{{$batch->id}} form-control form-control-sm" value="{{$batch->cap->kg_per_bag}}"></td>
                                               <td>{{$batch->cap->tot_cap}}</td>
                                               <td><input type="number" name="arr_no_cap[]" class="no_material_{{$batch->id}} form-control form-control-sm" readonly value="{{$batch->cap->no_cap}}"></td>
                                               <td hidden>{{$batch->cap->company}}</td>
                                           @endif
                                           @if(!empty($batch->label))
                                               <td>Label</td>
                                               <input type="hidden" name="arr_case[]" class="form-control form-control-sm" value="{{$batch->label->box->id}}">
                                               <td>{{$batch->label->box->case}}</td>
                                               <td><input type="number" name="arr_no_label_bag[]" class="no_bags_{{$batch->id}} form-control form-control-sm" value="{{$batch->label->no_bags}}"></td>
                                               <td><input type="text" name="arr_kg_per_bag_lbl[]" class="kg_per_bag_{{$batch->id}} form-control form-control-sm" value="{{$batch->label->kg_per_bag}}"></td>
                                               <td>{{$batch->label->tot_label}}</td>
                                               <td><input type="number" name="arr_no_label[]" class="no_material_{{$batch->id}} form-control form-control-sm" readonly value="{{$batch->label->no_label}}"></td>
                                               <td hidden>{{$batch->label->company}}</td>
                                           @endif
                                           <td hidden>{{$batch->comment}}</td>
                                           <td hidden><input type="hidden" name="arr_id[]" value="{{$batch->id}}">{{$batch->id}}</td>
                                        <td> <button data-toggle="modal" rel="{{$batch->id}}"  data-target="#addBatchDetailModal" class="detailBtn btn btn-outline-info btn-sm">
                                                View
                                            </button> |
                                            <a data-id="{{$batch->id}}" href="javascript:" id="update_material" role="button" class="update_material btn btn-success btn-sm">Update</a> |
                                            <a rel="{{$batch->id}}" href="javascript:" id="delete_material" role="button" class="delete_material btn btn-danger btn-sm">Delete</a>


                                        </td>

                                       </tr>

                                   @endforeach
                                   </tbody>

                               </table>
                           </div>

                       @include('admin.includes.add_material_detail')
                   </div>
{{--                   <div class="card-footer text-center">--}}
{{--                       <input type="submit" value="Update" class="btn btn-primary">--}}
{{--                   </div>--}}
                   </form>
               </div>
           </div>
       </div>
   </div>

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $("#view_batches").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $("#caps_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $("#labels_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $('#material').on('change',function () {
                var $mat = $(this).val();
                if($mat == 1)
                {
                    $('#pos').text('PRE-');
                    // $('#case').attr('required',true).show();
                }else if($mat == 2)
                {
                    $('#pos').text('CAP-');
                    // $('#case').removeAttr('required').hide();
                }else if($mat == 3)
                {
                    $('#pos').text('LBL-');
                    // $('#case').removeAttr('required').hide();
                }
                // var batch = $('#batch_name').val();
                $('#batch_name').val($('#post_name').text())
            });

            $(".detailBtn").on('click', function (e) {
                var id = $(this).attr('rel');
                e.preventDefault();

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                // console.log(data);
                $('#detail_title').text(data[1] +' Batch - ('+ data[0] +')');
                $('.mat_name').text(data[1]);
                $('#case_type').text(data[2]);
                var no_bags = $('.no_bags_'+id).val();
                var kg_per_bag = $('.kg_per_bag_'+id).val();
                    $('#no_of_bags').text(no_bags);
                $('#weight_per_bag').text(kg_per_bag);
                $('#tot_weight').text(no_bags*kg_per_bag);
                $('#mat_value').text(data[5]/no_bags);
                $('#tot_no_mat').text(data[5]);
                $('#weight_preform_g').text(no_bags*kg_per_bag*1000/data[5]);
                $('#company_id').text(data[7]);
                $('#comment_id').text(data[8]);
                $('#batch_id').text(data[9]);

            });

        });

        $(document).on('click', '.delete_material', function (e) {
            var id = $(this).attr('rel');
            // var deleteFunction = $(this).attr('rel1');
            // alert(deleteFunction);
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record again!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    window.location.href = '/admin/stock/delete/'+id;
                });

        })

        $(document).on('click', '.update_material', function (e) {
            var id = $(this).data('id');

            alert(id);

        })


    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
