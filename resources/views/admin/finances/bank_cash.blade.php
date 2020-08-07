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
                <h1><i class="fa fa-book-open"></i> Finances </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Finance </i> </a> - </li>
                    <li class="active">Cash to Bank</li>
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
               <div class="card" style="box-shadow: 0 0 25px 0 lightgrey ">
                   <div class="card-header bg-gradient-info">
                       <h5 class="card-title">Enter the Cash available to be moved to Bank in this section</h5>
                   </div>
                   <form action="{{route('cash.bank')}}" method="post" id="cash_form" >
                       @csrf
                       <div class="card-body" style="font-size: 13px">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="row my-0" >

                                       <label for="amount" class="col-sm-2 col-form-label text-right">Amount (&#8358):</label>
                                       <div class="col-sm-4" style="margin-top: 0.2rem">
                                           <input type="text" name="amount" id="amount" class="form-control form-control-sm" placeholder="Enter Amount to move" style="" required/>
                                       </div>
                                   </div>
                                   <hr class="my-0">
                                   <div class="row my-0" >

                                       <label for="amount" class="col-sm-2 col-form-label text-right">Bank:</label>
                                       <div class="col-sm-4" style="margin-top: 0.2rem">
                                           <select name="bank" class="form-control select2" style="width: 100%; height: 100% !important;" required>
                                               <option value="0" disabled selected="selected">Select bank name</option>
                                               @if(!empty($banks))
                                                   @foreach($banks as $bank)
                                                       <option value="{{$bank->name}}">{{$bank->name}}</option>
                                                   @endforeach
                                               @endif

                                           </select>
                                       </div>
                                   </div>
                                   <hr class="my-0">
                                   <div class="row my-0" >

                                       <label for="account_name" class="col-sm-2 col-form-label text-right">Account name:</label>
                                       <div class="col-sm-6" style="margin-top: 0.2rem">
                                           <input type="text" name="account_name" id="account_name" class="form-control form-control-sm" placeholder="Enter Account name" style="" required>
                                       </div>
                                   </div>
                                   <hr class="my-0">
                                   <div class="row my-0" >

                                       <label for="account_no" class="col-sm-2 col-form-label text-right">Account number:</label>
                                       <div class="col-sm-4" style="margin-top: 0.2rem">
                                           <input type="number" name="account_no" id="account_no"  class="form-control form-control-sm" placeholder="Enter Account Number " required data-inputmask='"mask": "99999-99999"' data-mask>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="row my-0" >
                                       <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                                       <div class="col-sm-5" style="margin-top: 0.2rem">
                                                   <textarea name="description" id="description"  rows="6" class="form-control form-control-sm" placeholder="Enter descriptions here . . ." ></textarea>

                                       </div>
                                   </div>
                               </div>
                           </div>

                           <hr class="my-1">


                       </div>

                       <div class="card-footer text-center">
                           <input type="submit" value="Save" class="btn btn-success">
                       </div>

                   </form>

               </div>
           </div>

           <div class="col-md-12">
               <div class="card">
{{--                   <div class="card-header bg-gradient-info">--}}
{{--                       <h5 class="card-title">View Batches</h5>--}}
{{--                   </div>--}}
{{--                   action="{{route('admin.editBatch')}}"--}}
                   <div class="card-header p-2 bg-gradient-light">
                       <strong><i class="fa fa-money-bill"></i> Cash to Bank</strong> - History
                       <div class="float-right" >
                           <form action="{{route('cash.to.bank.search')}}" method="POST" enctype="multipart/form-data">
                               @csrf

                               {{--                                <div class="container">--}}
                               <div class="row" style="font-size: 12px">
                                   <label for="from" class="col-form-label">From</label>
                                   <div class="col-md-4">
                                       <input type="date" class="form-control form-control-sm " id="from" name="from">
                                   </div>
                                   <label for="from" class="col-form-label">To</label>
                                   <div class="col-md-4">
                                       <input type="date" class="form-control form-control-sm" id="to" name="to">
                                   </div>

                                   <div class="col-md-1">
                                       <button type="submit" class="btn btn-primary btn-xs" name="search" >Search</button>
                                   </div>&nbsp;
                                   <div class="col-md-1">
                                       <button type="submit" class="btn btn-success btn-xs" name="exportPDF" >ExportPDF</button>
                                   </div>
                               </div>
                               {{--                                </div>--}}
                           </form>
                       </div>
                   </div><!-- /.card-header -->
                   <div class="card-body">

                           <input type="hidden" name="batch_id" id="batch_id">
                           <div class="table-responsive">


                               <table id="view_batches" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                   <thead>
                                   <tr>
                                       <th style="width: 7rem" >Date</th>
                                       <th style="width: 7rem">Time</th>
                                       <th style="width: 15rem">Amount</th>
                                       <th style="width: 15rem">Bank</th>
                                       <th style="width: 15rem">Account Name</th>
                                       <th style="width: 8rem">Account Number</th>
                                       <th style="width: 7rem" class="teller"></th>
                                       <th style="width: 15rem"></th>
                                       <th style="width: auto">Teller</th>
                                       <th style="width: 15rem">User</th>
                                       <th style="width: 15rem">Description</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                       @foreach($bundle  as $cash)

                                            <tr >
                                                <form action="{{route('teller', ['id'=>$cash->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                               <td >{{\Carbon\Carbon::parse($cash->created_at)->toDateString()}}</td>
                                               <td>{{\Carbon\Carbon::parse($cash->created_at)->format('H:i:s A')}}</td>
                                                <td>&#8358 {{number_format($cash->amount)}}</td>
                                                <td> {{($cash->bank)}}</td>
                                                <td> {{($cash->account_name)}}</td>
                                                <td> {{($cash->account_no)}}</td>
                                                <td class="teller"><input type="submit" class="btn btn-outline-info btn-sm" value="Save Teller"></td>
                                                <td>
                                                    <input type="file" name="teller" id="teller" class="form-control form-control-sm">
                                                </td>
                                                <td> <a href="{{asset($cash->teller)}}">{{!empty($cash->teller) ? 'Teller' : ''}}</a></td>
                                                <td>{{$cash->admin->employee->name}}</td>
                                                    <td> {{($cash->description)}}</td>
                                                </form>
                                           </tr>

                                       @endforeach

                                   </tbody>

                               </table>

                           </div>
                       @include('admin.includes.add_material_detail')



                   </div>
               </div>
           </div>
       </div>

   </div>

@endsection
@section('scripts')
    <!-- DataTables -->
<script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

			$('[data-mask]').inputmask();

            $("#view_batches").DataTable({
                "responsive": true,
                "autoWidth": false,
                "footer": true,
                "aaSorting": [ [0,'desc'], [1,'desc'] ],
                dom: 'Bfrtip',
                lengthMenu: [[10,25,50,100, -1], [10, 25, 50,100, "All"]],
                buttons: [
                    'colvis',
                    'excel',
                    {
                        extend: "pdfHtml5",
                        // orientation: 'landscape',
                        exportOptions: {
                            columns: ':visible'
                        },
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
                ],
                columnDefs: [ {
                    targets: -1,
                    visible: false
                } ]
            });

            $('.teller').hide();
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                if (fileName)
                {
                    $('.teller').show();
                }else
                {
                    $('.teller').hide();
                }
            });

			$.validator.setDefaults({
                highlight: function(element) {

                    $(element).closest('.form-group').addClass('has-error');
                    $(element).addClass('is-invalid');

                },
                unhighlight: function(element) {

                    $(element).closest('.form-group').removeClass('has-error');
                    $(element).removeClass('is-invalid');

                },
                errorElement: 'span',
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('#cash_form').validate({
                rules:{
                    amount:{
                        required: true
                    },
                    bank:{
                        required: true
                    },
                    account_name:{
                        required: true
                    },
                    account_no:{
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    }

                },
                messages: {
                    amount: {
                        required: "Please enter amount",
                    },
                    bank: {
                        required: "Please select a Bank name from the list"
                    },
                    account_name: {
                        required: "Please enter account number",
                    },
                    account_no: {
                        minlength: "Account Number must be 10 digit ",
                        maxlength: "Account Number must be 10 digit ",
                    }
                }
            });
        });



    </script>


    <script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#cash_form" );
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

