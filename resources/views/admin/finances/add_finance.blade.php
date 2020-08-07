@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

    <!-- DataTables -->
{{--    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">--}}
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
                    <li class="active">Add Income/Expense</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row" >

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <h5 class="card-title">Add - <strong>Income</strong></h5>
                        </div>
                        <form action="{{route('finance.income')}}" method="post" id="income_add"  style="font-size: 0.8rem">
                            @csrf
                            <div class="card-body">
                               <div class="form-group row my-0" >
{{--                                    <label for="type_income" class="col-sm-2 col-form-label text-right">Type</label>--}}
{{--                                    <div class="col-sm-4" style="margin-top: 0.3rem">--}}
                                        <select name="type" id="type_income" class="form-control form-control-sm" hidden>
{{--                                            <option value="">Select Income Type</option>--}}
                                            <option value="C-fresh" selected>C-fresh</option>
{{--                                            <option value="Others">Cash deposited</option>--}}
                                        </select>

{{--                                    </div>--}}

                                   <div class="custom-control custom-radio col-sm-1 mt-2 ml-3 cash_option">
                                       <input class="custom-control-input" type="radio" id="wired" name="cash_type">
                                       <label for="wired" class="custom-control-label">Wired</label>
                                   </div>
                                   <div class="custom-control custom-radio col-sm-1 mt-2 ml-5 cash_option">
                                       <input class="custom-control-input" type="radio" id="cash" name="cash_type" >
                                       <label for="cash" class="custom-control-label">Cash</label>
                                   </div>
                                   <div class="custom-control custom-checkbox col-sm-1 mt-2 ml-5 cash_option">
                                       <input class="custom-control-input" type="checkbox" id="source" name="source" >
                                       <label for="source" class="custom-control-label">Customer</label>
                                   </div>

                                </div>
                                <hr class="my-0">
                                <div class="form-group row my-0" >
                                    <label for="amount" class="col-sm-2 col-form-label text-right">Amount</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem">
                                        <input type="text" name="amount" id="amount_income" min="1" class="form-control form-control-sm " required>

                                    </div>

                                    <label for="collector_income" class="col-sm-2 col-form-label text-right">Collector</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem">
                                        <select name="collector" id="collector_income" class="form-control form-control-sm" required>
                                            <option value="">Select Employee Type</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <hr class="my-0">

                                <div class="form-group row my-0" >
                                    <label for="description_income" class="col-sm-2 col-form-label text-right">Description</label>
                                    <div class="col-sm-9" style="margin-top: 0.3rem; ">
                                        <textarea name="description" id="description_income"  class="form-control form-control-sm" required></textarea>
                                    </div>

                                </div>
                                <hr class="my-0">
                                <div class="form-group row my-0" id="source_customer">
                                    <label for="customer" class="col-sm-2 col-form-label text-right">Customer</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem">
                                        <select name="customer" id="customer_paid" class="form-control form-control-sm" required>
                                            <option value="">Select Customer Type</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <hr class="my-1" >

                            </div>

                            <div class="card-footer text-center">
                                <input type="submit" value="Add Income" id="submit_income" class="btn btn-outline-success">
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <h5 class="card-title">Add - <strong>Expenses</strong></h5>
                        </div>
                        <form action="{{route('finance.expense')}}" method="post" id="expense_add" enctype="multipart/form-data" style="font-size: 0.8rem">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row my-0" >
{{--                                    <label for="type" class="col-sm-2 col-form-label text-right">Type</label>--}}
{{--                                    <div class="col-sm-4" style="margin-top: 0.3rem">--}}
                                        <select name="type" id="type" class="form-control form-control-sm" hidden>
{{--                                            <option value="">Select Expenses Type</option>--}}
                                            <option value="C-fresh" selected>C-fresh</option>
{{--                                            <option value="Others">Cash Expense</option>--}}
                                        </select>

{{--                                    </div>--}}

                                    <div class="custom-control custom-radio col-sm-1 mt-2 ml-3 expense_option">
                                        <input class="custom-control-input" type="radio" id="expense_wired" name="expense_type">
                                        <label for="expense_wired" class="custom-control-label">Wired</label>
                                    </div>
                                    <div class="custom-control custom-radio col-sm-1 mt-2 ml-5 expense_option">
                                        <input class="custom-control-input" type="radio" id="expense_cash" name="expense_type" >
                                        <label for="expense_cash" class="custom-control-label">Cash</label>
                                    </div>


                                </div>
                                <hr class="my-0">
                                <div class="form-group row my-0" >
                                    <label for="amount" class="col-sm-2 col-form-label text-right">Amount</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem">
                                        <input type="text" name="amount" id="amount" min="1" class="form-control form-control-sm " required>
                                    </div>

                                    <label for="type" class="col-sm-2 col-form-label text-right">Collector</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem">
                                        <select name="collector" id="collector" class="form-control form-control-sm">
                                            <option value="">Select Employee Type</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->name}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <hr class="my-0">

                                <div class="form-group row my-0" >
                                    <label for="amount_type" class="col-sm-2 col-form-label text-right">Description</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem; ">
                                        <textarea name="description" id="description"  class="form-control form-control-sm"></textarea>
                                    </div>

                                    <label for="amount_type" class="col-sm-2 col-form-label text-right">Receipt</label>
                                    <div class="col-sm-4" style="margin-top: 0.3rem; ">
                                        <input type="file" name="image">
                                    </div>

                                </div>
                                <hr class="my-1" >

                            </div>

                            <div class="card-footer text-center">
                                <input type="submit" value="Add Expenses" class="btn btn-outline-info">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-gradient-info">
                            <h5 class="card-title">Add - <strong>Credit</strong></h5>
                        </div>
                        <form action="{{route('finance.credit')}}" method="post" id="credit_form" style="font-size: 0.8rem">
                            @csrf
                           {{-- <div class="card-body">
                                <div class="form-group row my-0" >
                                    <select name="type" id="type" class="form-control form-control-sm" hidden>
                                        <option value="C-fresh" selected>C-fresh</option>
                                    </select>
                                </div>
--}}{{--                                <hr class="my-0">--}}{{--
                                <div class="form-group row my-0" >
                                    <label for="amount" class="col-sm-1 col-form-label text-right">Amount</label>
                                    <div class="col-sm-2" style="margin-top: 0.3rem">
                                        <input type="text" name="amount" id="amount" min="1" class="form-control form-control-sm " required>
                                    </div>

                                    <div class="custom-control custom-radio col-sm-2 mt-2 ml-3 text-right">
                                        <input class="custom-control-input" type="radio" id="credit_wired" name="credit_type">
                                        <label for="credit_wired" class="custom-control-label">Wired</label>
                                    </div>
                                    <div class="custom-control custom-radio col-sm-1 mt-2 ml-5">
                                        <input class="custom-control-input" type="radio" id="credit_cash" name="credit_type" >
                                        <label for="credit_cash" class="custom-control-label">Cash</label>
                                    </div>

                                    <label for="type" class="col-sm-2 col-form-label text-right">Collector</label>
                                    <div class="col-sm-3" style="margin-top: 0.3rem">
                                        <select name="collector" id="collector" class="form-control form-control-sm">
                                            <option value="">Select Employee Type</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->name}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>

                                <hr class="my-1" >

                            </div>--}}
                            <div class="container pr-3 pl-3 my-3">
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="amount">Amount</label>
                                            <input type="text" name="amount" id="amount" min="1" value="{{old('amount')}}" class="form-control form-control-sm {{$errors->has('amount') ? 'is-invalid' : ''}}" >

                                        @if($errors->has('amount'))
                                            <div class="invalid-feedback">
                                                <strong>{{$errors->first('amount')}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="custom-control custom-radio col-md-5 mb-3">
                                        <div class="col-sm-2 mt-4 text-right" style="margin-left: 4rem;">
                                            <input class="custom-control-input " type="radio" id="credit_wired" name="credit_type"  @if(old('credit_type')) checked @endif>
                                            <label for="credit_wired" class="custom-control-label">Wired</label>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: 10rem; margin-top: -1.2rem">
                                            <input class="custom-control-input" type="radio" id="credit_cash" name="credit_type" @if(old('credit_type')) checked @endif>
                                            <label for="credit_cash" class="custom-control-label">Cash</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="employee_id">Collector</label>
                                        <select name="collector" id="employee_id" class="form-control form-control-sm {{$errors->has('collector') ? 'is-invalid' : ''}}" >
                                            <option selected disabled value="">Choose...</option>
                                            @foreach($employees as $employee)
                                                @if (old('collector') == $employee->id)
                                                    <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                                                @else
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endif
{{--                                                <option value="{{$employee->id}}">{{$employee->name}}</option>--}}
                                            @endforeach
                                        </select>
                                        @if($errors->has('collector'))
                                            <div class="invalid-feedback">
                                                <strong>{{$errors->first('collector')}}</strong>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>


                            <div class="card-footer text-center">
                                <input type="submit" value="Add Credit" class="btn btn-outline-warning">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- DataTables -->
{{--    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>--}}
    <script src="{{asset('js/backend/bootstrap.validation.js')}}"></script>
{{--    <script src="{{asset('js/backend/validation.js')}}"></script>--}}
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            // $("#view_batches").DataTable({
            //     "responsive": true,
            //     "autoWidth": false,
            // });

        });

        $(document).ready(function () {
            // $('.cash_option').hide();

            // $('#type_income').change(function () {
            //     var type = $(this).val();
            //     if(type == 'C-fresh')
            //     {
            //         $('.cash_option').show();

            $('#wired').on('click', function () {
                if((this).checked)
                {
                    $("input[name='cash_type']").val('Wired');
                }
            });
            $('#cash').on('click', function () {
                if((this).checked)
                {
                    $("input[name='cash_type']").val('Cash');
                }
            });

                // }else
                // {
                //     $('.cash_option').hide();
                // }
            // });

            $('#source_customer').hide();
            $("input[name='customer']").attr('required',false);
            $('#source').on('click', function () {
                // alert('Dee Checked');
                if((this).checked)
                {
                    $('#source_customer').show();
                    $("input[name='customer']").val(1);
                    $("input[name='customer']").attr('required',true);
                }else
                {
                    // alert('Dee Unchecked');
                    $('#source_customer').hide();
                    $("input[name='customer']").val(0);
                    $("input[name='customer']").attr('required',false);
                }
            });

            $('#expense_wired').on('click', function () {
                if((this).checked)
                {
                    $("input[name='expense_type']").val('Wired');
                }
            });
            $('#expense_cash').on('click', function () {
                if((this).checked)
                {
                    $("input[name='expense_type']").val('Cash');
                }
            });

            $('#credit_wired').on('click', function () {
                if((this).checked)
                {
                    $("input[name='credit_type']").val('Wired');
                }
            });
            $('#credit_cash').on('click', function () {
                if((this).checked)
                {
                    $("input[name='credit_type']").val('Cash');
                }
            });

        });



    </script>

    <script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#income_add" );
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

    <script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $form = $( "#credit_form" );
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
