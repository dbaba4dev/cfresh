@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
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
                       <h5 class="card-title">New Material - <strong>Batch</strong></h5>
                   </div>
                   <form action="{{route('stocks')}}" method="post" id="batch_form" enctype="multipart/form-data">
                       @csrf
                       <input type="hidden" name="pos" id="pos" value="">
                       <div class="card-body" style="font-size: 13px">
                           <div class="row my-0" >
                               <label for="product_code" class="col-sm-1 col-form-label text-right">Batch Code</label>
                               <div class="col-sm-2" style="margin-top: 0.2rem">
                                   <input type="text" name="new_batch" id="new_batch" value="{{$Batch_name}}" class="form-control form-control-sm" readonly style="background: #33779f; color: #fff; font-weight: bold">
                               </div>

{{--                               <label for="product_name" id="post_name" class="col-sm-3 col-form-label text-center"><strong><span id="pos"></span>{{$Batch_name}}</strong></label>--}}
                                <div class="col-sm-5"></div>
                               <label for="material" class="col-sm-1 col-form-label text-right">Cost (&#8358):</label>
                               <div class="col-sm-2" style="margin-top: 0.2rem">
                                   <input type="text" name="amount" id="amount" class="form-control form-control-sm" placeholder="Purchased Amount" style="" required/>
                               </div>
                           </div>
                           <hr class="my-1">

                           <div class="form-group row my-0" >
{{--                               <div class="col-md-6">--}}
                                   <label for="material" class="col-sm-1 col-form-label text-right">Material</label>
                                   <div class="col-sm-3" style="margin-top: 0.2rem">
                                       <select name="material" id="material" class="form-control form-control-sm select2" required>
                                           <option value="" selected disabled>Select Material</option>
                                           @foreach($materials as $material)
                                               <option value="{{$material->id}}">{{$material->name}}</option>
                                           @endforeach
                                       </select>
                                   </div>
{{--                               </div>--}}
                                   <label for="company" class="col-sm-1 col-form-label text-right">Company</label>
                                   <div class="col-sm-3" style="margin-top: 0.2rem">
                                       <input type="text" name="company" id="company" class="form-control form-control-sm" placeholder="Company name" style=""/>
                                   </div>

{{--                               <form action="{{route('uploadSubmit')}}" method="post" enctype="multipart/form-data" >--}}
{{--                                   <div class="col-sm-2 file-field small"  style="padding-left: 1rem; margin-top: 0.6rem; font-size: 12px">--}}
                                       <label for="files" class="col-sm-2 col-form-label text-right">Upload Document(s):</label>

{{--                                       <label id="upload" class="fas fa-cloud-upload-alt fa-2x" style="font-size: 12px; padding-left: 1rem">--}}
                                       <div class="col-sm-2" style="margin-top: 0.2rem">
                                           <input type="file" multiple="multiple" id="files" name="files[]" class="form-control form-control-sm" >
                                       </div>
{{--                                       </label>--}}
{{--                                       <button type="submit" class="btn btn-outline-info btn-xs" style="margin-top:-0.2rem; margin-left: 2rem">Submit</button>--}}
{{--                                   </div>--}}
{{--                               </form>--}}

                           </div>
                           <hr class="my-0">

                           <div class="form-group row my-0" >
                               <label for="product_color" class="col-sm-1 col-form-label text-right">New Batch</label>
                               <div class="field_wrapper">
                                   <div style="margin-top: 0.3rem">
                                       <div class="row" style="margin-right: 0.3rem">
                                        <div class="col-sm-2">
                                            <input type="number" name="no_bags" id="no_bags" min="0" class="form-control form-control-sm" placeholder="No. of Bags" required/>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="kg_bags" id="kg_bags" class="form-control form-control-sm" placeholder="Weight per Bag (kg)" required/>
                                        </div>
                                        <div class="col-sm-3"> <input type="text" name="preform_g" id="preform_g"  class="form-control form-control-sm" placeholder="Unit weight (g)" required/></div>
                                       <div class="col-sm-2">
                                           <select name="case" id="case" class="form-control form-control-sm" required>
                                               <option value="" selected disabled>Case Type</option>
                                               @foreach($cases as $case)
                                                   <option value="{{$case->id}}">{{$case->case}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       </div>
                                   </div>

                               </div>

                           </div>
                           <hr class="my-1">
                           <div class="form-group row my-0" >
                               <label for="comment" class="col-sm-1 col-form-label text-right">Description</label>
                               <div class="col-sm-6" style="margin-left: -0.3rem">
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
{{--                   action="{{route('admin.editBatch')}}"--}}
                   <form   method="post" id="edit_batch_form" >
                       @csrf
                   <div class="card-body">

                           <input type="hidden" name="batch_id" id="batch_id">
                           <div class="table-responsive">
                               <table id="view_batches" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                   <thead>
                                   <tr>
                                       <th style="width: auto">Batch Code</th>
                                       <th style="width: auto" >Date</th>
                                       <th style="width: auto">Time</th>
                                       <th style="width: auto">Material</th>
                                       <th style="width: auto">Case</th>
                                       <th style="width: 6rem">No. Bags</th>
                                       <th style="width: 4rem">Weight per Bag (kg)</th>
                                       <th style="width: auto">Total Materials</th>
                                       <th style="width: 5rem">No. Material per Bag</th>
                                       <td >Attachment</td>
                                       <td hidden></td>
                                       <td hidden></td>
                                       <th style="width: auto"></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($batches  as $batch)
                                       @if($batch->comment != 1)
                                        <tr id="{{$batch->id}}">
                                           <td >{{$batch->name}}</td>
                                           <td >{{\Carbon\Carbon::parse($batch->created_at)->toFormattedDateString()}}</td>
                                           <td>{{\Carbon\Carbon::parse($batch->created_at)->format('H:i:s A')}}</td>

{{--                                           @if(!empty($batch->preform))--}}
                                           @if(!empty($batch->preform))
                                               <td>Preform</td>
                                               <input type="hidden" name="case_name" class="case_name_{{$batch->id}} form-control form-control-sm" value="{{$batch->preform->box['id']}}">
                                               <td>{{$batch->preform->box['case']}}</td>
                                               <td><input  type="number"  name="no_preform_bag"  class="inp form-control form-control-sm no_bags_{{$batch->id}}" readonly value="{{$batch->preform->no_bags}}"></td>
                                               <td><input type="text" name="kg_per_bag_pre" class="inp form-control form-control-sm kg_per_bag_{{$batch->id}}"  readonly value="{{$batch->preform->kg_per_bag}}"></td>
                                               <td><strong>{{$batch->preform->tot_preform}}</strong></td>
                                               <td><input type="number" name="no_preform" class="inp form-control form-control-sm no_material_{{$batch->id}}" readonly value="{{$batch->preform->no_preform}}"></td>
                                               <td hidden>{{$batch->preform->company}}</td>
                                           @endif
                                           @if(!empty($batch->cap))
                                               <td>Cap</td>
                                               <input type="hidden" name="case_name" class="case_name_{{$batch->id}} form-control form-control-sm" value="{{$batch->cap->box['id']}}">
                                               <td>{{$batch->cap->box['case']}}</td>
                                               <td><input type="number"  name="no_cap_bag" class="inp form-control form-control-sm no_bags_{{$batch->id}}" readonly value="{{$batch->cap->no_bags}}"></td>
                                               <td><input type="text" name="kg_per_bag_cap" class="inp form-control form-control-sm kg_per_bag_{{$batch->id}}" readonly value="{{$batch->cap->kg_per_bag}}"></td>
                                               <td><strong>{{$batch->cap->tot_cap}}</strong></td>
                                               <td><input type="number" name="no_cap" class="inp form-control form-control-sm no_material_{{$batch->id}}" readonly value="{{$batch->cap->no_cap}}"></td>
                                               <td hidden>{{$batch->cap->company}}</td>
                                           @endif
                                            @if(!empty($batch->label))
                                               <td>Label</td>
                                               <input type="hidden" name="case_name" class="case_name_{{$batch->id}} form-control form-control-sm" value="{{$batch->label->box['id']}}">
                                               <td class="">{{$batch->label->box['case']}}</td>
                                               <td><input type="number" name="no_label_bag" class="inp form-control form-control-sm no_bags_{{$batch->id}}" readonly value="{{$batch->label->no_bags}}"></td>
                                               <td><input type="text" name="kg_per_bag_lbl" class="inp form-control form-control-sm kg_per_bag_{{$batch->id}}" readonly value="{{$batch->label->kg_per_bag}}"></td>
                                               <td><strong>{{$batch->label->tot_label}}</strong></td>
                                               <td><input type="number" name="no_label" class="inp form-control form-control-sm no_material_{{$batch->id}}" readonly value="{{$batch->label->no_label}}"></td>
                                               <td hidden>{{$batch->label->company}}</td>
                                           @endif
                                           <td>
                                               @foreach(\App\Batch_doc::getDocs($batch->id) as $doc)
                                                   <a href="{{asset($doc->doc_path)}}"><span class="badge badge-info right">{{$doc->name}}</span>&nbsp;
                                                       <span class="btn btn-success btn-xs" style="font-size: 6px">Edit</span>&nbsp;
                                                       <span class="btn btn-danger btn-xs" style="font-size: 6px">x</span>
                                                   </a>, &nbsp;
                                               @endforeach
                                           </td>
                                           <td hidden></td>
                                        <td> <button data-toggle="modal" rel="{{$batch->id}}"  data-target="#addBatchDetailModal1" class="detailBtn btn btn-outline-info btn-xs">
                                                View
                                            </button> |
{{--                                            <a data-id="{{$batch->id}}" href="javascript:" id="update_material" role="button" class="update_material btn btn-success btn-xs">Update</a> |--}}
                                            <a rel="{{$batch->id}}" href="javascript:" id="delete_material" role="button" class="delete_material btn btn-danger btn-xs">Delete</a>
                                        </td>


                                       </tr>
                                       @endif

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
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();


            $("#view_batches").DataTable({
                "responsive": true,
                "autoWidth": false,
                "aaSorting": [ [1,'desc'], [2,'desc'] ],
                dom: 'Bfrtip',
                lengthMenu: [[10,25,50,100, -1], [10, 25, 50,100, "All"]],
                buttons: [
                    'excel',
                    {
                        extend: "pdfHtml5",

                        customize: function(doc) {
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'center',
                                            text: [
                                                { text: page.toString(), italics: true },
                                                ' of ',
                                                { text: pages.toString(), italics: true }
                                            ]
                                        }],
                                    margin: [10, 0]
                                }
                            });
                        }
                    },
                    'print',
                    'pageLength'
                ]
            });



            $('#upload').css('cursor', 'pointer');

            $('#material').on('change',function () {
                var $mat = $(this).val();
                if($mat == 1)
                {
                    $('#pos').val('PRE-');
                    // $('#case').attr('required',true).show();
                }else if($mat == 2)
                {
                    $('#pos').val('CAP-');
                    // $('#case').removeAttr('required').hide();
                }else if($mat == 3)
                {
                    $('#pos').val('LBL-');
                    // $('#case').removeAttr('required').hide();
                }
                $batch = $('#new_batch').val();
                var pre_code = $('#pos').val();

                $.ajax({
                    url: 'selected-material',
                    method: 'get',
                    dataType: 'json',
                    data: { material:$mat, code:pre_code},
                    success: function (data) {
                        console.log('Dee '+data);
                        $('#new_batch').val(data);
                        // calculate(discount,0);
                    }
                });
            });

            $(".detailBtn").on('click', function (e) {
                e.preventDefault();
                var id = $(this).attr('rel');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#detail_title').text(data[3] +' Batch - ('+ data[0] +')');
                $('.mat_name').text(data[3]);
                $('#case_type').text(data[4]);
                var no_bags = $('.no_bags_'+id).val();
                var kg_per_bag = $('.kg_per_bag_'+id).val();
                    $('#no_of_bags').text(no_bags);
                $('#weight_per_bag').text(kg_per_bag);
                $('#tot_weight').text(no_bags*kg_per_bag);
                $('#mat_value').text((data[7]/no_bags).toFixed(1));
                $('#tot_no_mat').text(data[7]);
                $('#weight_preform_g').text((no_bags*kg_per_bag*1000/data[7]).toFixed(1));
                $('#company_id').text(data[9]);
                $('#comment_id').text(data[10]);
                $('#batch_id').text(data[11]);

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

        });

        $(document).on('click', '.update_material', function (e) {
            var id = $(this).data('id');
            $('#batch_id').val(id);
            // alert(id);

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).find('.inp').val();
            }).get();

            var no_bags=data[0];
            var kg_per_bag=data[1];
            var no_material_bag=data[2];
            var case_id = $('.case_name_'+id).val();

            $.ajax({
                type: "POST",
                url: "edit/batch/"+id,
                data: { "_token":"{{ csrf_token() }}", batch_id:id, no_bags:no_bags, kg_per_bag:kg_per_bag, no_material_bag:no_material_bag, case_id:case_id},
                success: function (response) {
                    // console.log(response);

                    location.reload();
                },
                error: function (resp) {
                    alert('Error');
                }

            });

        });


    </script>
    <script>
        $('#no_bags').on('keyup',function () {
            var bag = $(this).val();
            if(bag<0)
            {
                alert('Number of bags cannot be less than zero, please try again!');
            }
        })
    </script>

    <script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#batch_form" );
                var $input = $form.find( "input[name='amount']" );

                $input.on( "keyup", function( event ) {

                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }

                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }

                    var $this = $( this );

                    // Get the value.
                    var input = $this.val();

                    var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                    } );
                } );

            });
        })(jQuery);
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



@endsection

