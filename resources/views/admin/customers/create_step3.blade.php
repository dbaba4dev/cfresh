@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <link rel="stylesheet" href="{{asset('backend/css/opensans-font.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/montserrat-font.css')}}">
    <link rel="stylesheet" href="{{asset('backend/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-users"></i> Customers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> New Customer</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header bg-gradient-info">
                        {{--                       <span class="icon"><i class=""></i></span>--}}
                        <h5 class="card-title">New Customer - <strong>Vendor Details</strong></h5>
                        <div class="float-right">Step 3 of 3</div>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('customers.create_step3', ['id'=>$userDetail->id])}}" method="post" id="addCustomer">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row my-0" >
                                <label for="vendor_id" class="col-sm-2 col-form-label text-right">Sales Reps.</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="employee" id="employee" class="form-control form-control-sm select2" required>
                                        <option value="">Select a Sale Rep.</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->name}}"
                                                    @if($userDetail->vendor == $employee->name)
                                                    selected
                                                @endif
                                            >{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <div class="float-left">
                                <a href="{{route('customers.create_step2', ['id'=>$userDetail->id])}}" class="btn btn-outline-info btn-sm">Previous</a>
                            </div>
                            <div class="float-right">
                                <input type="submit" value="Save" class="btn btn-success btn-sm">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection

@section('scripts')
{{--    <script src="{{asset('backend/vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>--}}
    <script src="{{asset('backend/js/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                width: 200
            });

        });

        // $('#stepwidzard').smartWizard();
    </script>

@endsection
