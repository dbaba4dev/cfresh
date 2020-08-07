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
                <h1><i class="fa fa-book-open"></i> Damages Record  </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Products </i> </a> - </li>
                    <li class="active">Damages</li>
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
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        {{--                       <span class="icon"><i class=""></i></span>--}}
                        <h5 class="card-title">Damages</h5>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('damages')}}" method="post" id="finished_prd">
                        @csrf
                        <div class="card-body">

{{--                            <div class="form-group row my-0" >--}}
{{--                                <label for="material" class="col-sm-2 col-form-label text-right">Damages </label>--}}
{{--                                <div class="col-sm-2" style="margin-top: 0.3rem">--}}
{{--                                    <select name="material" id="material" class="form-control form-control-sm select2" required>--}}
{{--                                        <option value="" selected disabled>Select Damage Material</option>--}}
{{--                                        <option value="Preforms">Preforms</option>--}}
{{--                                        <option value="Caps">Caps</option>--}}
{{--                                        <option value="Labels">Labels</option>--}}
{{--                                        <option value="Cases">Cases</option>--}}

{{--                                    </select>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <hr class="my-0">--}}

                            <div class="form-group row my-0" >
                                <label for="batch" id="lblBatch" class="col-sm-2 col-form-label text-right">Batch</label>
                                <div class="col-sm-3 sinble_batch" style="margin-top: 0.3rem" >
                                    <select name="batch" id="batch" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Choose Batch on Process</option>
                                        @foreach($batchs as $batch)
                                            @if(!empty($batch->preform) && $batch->preform->no_bags > 0)
                                                <option value="{{$batch->name}}">{{$batch->name}}</option>
                                            @elseif(!empty($batch->cap) && $batch->cap->no_bags > 0)
                                                <option value="{{$batch->name}}">{{$batch->name}}</option>
                                            @elseif(!empty($batch->label) && $batch->label->no_bags > 0)
                                                <option value="{{$batch->name}}">{{$batch->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3 icheck-primary d-inline col-sm-1 text-left">
                                    <input type="checkbox" id="cases" name="cases" value="1" class="form-control" >
                                    <label for="cases">
                                        Damage Cases
                                    </label>
                                </div>

                            </div>

                            <hr class="my-1">
                            <div class="form-group row my-0" id="batches">
                                <label for="batch"  class="col-sm-2 col-form-label text-right">Batch</label>
                                <div class="col-sm-3" style="margin-top: 0.3rem">
                                    <select name="pre_batch" id="pre_batch" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Select Preform Batch in Use</option>
                                        @foreach($batch_pres as $batch)
                                            <option value="{{$batch->name}}">{{$batch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3" style="margin-top: 0.3rem">
                                    <select name="cap_batch" id="cap_batch" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Select Cap Batch in Use</option>
                                        @foreach($batch_caps as $batch)
                                            <option value="{{$batch->name}}">{{$batch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3" style="margin-top: 0.3rem">
                                    <select name="lbl_batch" id="lbl_batch" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Select Label Batch in Use</option>
                                        @foreach($batch_lbls as $batch)
                                            <option value="{{$batch->name}}">{{$batch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <hr class="my-1">

                            <div class="form-group row my-0" >
                                <label for="quantity" class="col-sm-2 col-form-label text-right">Quantity</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="number" name="quantity" id="quantity" min="0" class="form-control form-control-sm " required>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="comment" class="col-sm-2 col-form-label text-right">Comment</label>
                                <div class="col-sm-9" style="margin-left: -0.3rem">
                                    <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Save Record" class="btn btn-success">
                        </div>

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
                "aaSorting": [ [0,'desc'], [1,'desc'] ],
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

            $('#batches').hide();
            $('#pre_batch').attr('required', false);
            $('#cap_batch').attr('required', false);
            $('#lbl_batch').attr('required', false);

            $('#cases').on('click', function () {
                if((this).checked)
                {
                    $('#batches').show();
                    $('#lblBatch').text('********');
                    // $('.sinble_batch').hide();
                    $('#batch').attr('disabled', true);
                    $('#batch').attr('required', false);
                    $('#pre_batch').attr('required', true);
                    $('#cap_batch').attr('required', true);
                    $('#lbl_batch').attr('required', true);
                }else
                {
                    $('#lblBatch').text('Batch');
                    $('#batches').hide();
                    $('#batch').attr('disabled', false);
                    $('#batch').attr('required', true);
                    $('#pre_batch').attr('required', false);
                    $('#cap_batch').attr('required', false);
                    $('#lbl_batch').attr('required', false);
                }
            });

        });


    </script>

    <script>
        // $('#finished_prd').validate({
        //     rules:{
        //         product_type:{
        //             required: true
        //         },
        //         quantity:{
        //             required: true,
        //             number:true
        //         },
        //         store_keeper:{
        //             required: true
        //         },
        //
        //     },
        //     errorClass: 'help-inline',
        //     errorElement: 'span',
        //     highlight:function (element, errorClass, validClass) {
        //         $(element).parents('.form-group').addClass('error');
        //     },
        //     unhighlight:function (element, errorClass, validClass) {
        //         $(element).parents('.form-group').removeClass('error');
        //         $(element).parents('.form-group').addClass('success');
        //     }
        // });
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
