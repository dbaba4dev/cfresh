@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <link rel="stylesheet" href="{{asset('css/bootstrap4_toggle.css')}}">
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
                        <h5 class="card-title">New Customer - <strong>Personal Information</strong></h5>
                        <div class="float-right">Step 2 of 3</div>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('customers.create_step2', ['id'=>$userDetail->id])}}" method="post" id="addCustomer">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row my-0" >
                                <label for="address" class="col-sm-2 col-form-label text-right">Address</label>
                                <div class="col-sm-6" style="margin-top: 0.3rem">
                                    <input type="text" name="address" id="address" class="form-control form-control-sm " value="{{!empty($userDetail) ? $userDetail->address : ''}}" required>

                                </div>

                            </div>

                            <hr class="my-0">
                            <div class="form-group row my-0" >
                                <label for="phone" class="col-sm-2 col-form-label text-right">Phone Number</label>
                                <div class="col-sm-3" style="margin-top: 0.3rem">
                                    <input type="tel" name="phone" id="phone" class="form-control form-control-sm " value="{{!empty($userDetail) ? $userDetail->mobile : ''}}" required>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="state" class="col-sm-2 col-form-label text-right">State</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="state" id="state" class="form-control form-control-sm select2" required>
                                        <option value=""> - - - - Select State - - - - </option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}"
                                                    @if(!empty($userDetail->state))
                                                    @if($userDetail->state->id == $state->id)
                                                    selected
                                                @endif
                                                @endif
                                            >{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <hr class="my-0">
                            <div class="form-group row my-0" >
                                <label for="lga" class="col-sm-2 col-form-label text-right">LGA</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="lga" id="lga" class="form-control form-control-sm select2" required>
                                        <option value="">- - - - Select LGA - - - - -</option>
                                        @foreach($lgas as $lga)
                                            <option value="{{$lga->id}}"
                                                @if($userDetail->lga_id == $lga->id)
                                                selected
                                                @endif
                                            >{{$lga->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <hr class="my-0">
                            <div class="form-group row my-0" >
                                <label for="religion" class="col-sm-2 col-form-label text-right">Religion</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="religion" id="religion" class="form-control form-control-sm select2">
                                        <option value="Islam" @if(!empty($userDetail->religion)){{$userDetail->religion == 'Islam' ? 'selected' : ''}}@endif>Islam</option>
                                        <option value="Christian" @if(!empty($userDetail->religion)){{$userDetail->religion == 'Christian' ? 'selected' : ''}}@endif>Christian</option>
                                        <option value="Others" @if(!empty($userDetail->religion)){{$userDetail->religion == 'Others' ? 'selected' : ''}}@endif>Others</option>
                                    </select>
                                </div>

                            </div>

                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="gender" class="col-sm-2 col-form-label text-right">Gender</label>
                                <div class="col-sm-6" style="margin-top: 0.3rem">
                                    <input type="checkbox" id="gender" name="gender" data-toggle="toggle" @if(!empty($userDetail->gender)) {{ $userDetail->gender == 'Male' ? 'checked' : ''}}  @endif data-on="Male" data-off="Female" data-onstyle="success" data-offstyle="danger" data-size="sm">
{{--                                    <input type="checkbox" name=gender" id="gender" data-on-text="Male" data-off-text="Female" value="{{!empty($userDetail->gender) ? $userDetail->gender : ''}}"   data-bootstrap-switch data-off-color="danger" data-on-color="success">--}}
                                </div>

                            </div>

                            <hr class="my-1">
                            <div class="form-group row my-0" >
                                <label for="dob" class="col-sm-2 col-form-label text-right">Date of Birth</label>
                                <div class="col-sm-3 text-left">
                                    <input type="date" id="dob" name="dob" required class="form-control" value="{{!empty($userDetail->dob) ? $userDetail->dob : ''}}" >
                                </div>
                            </div>
                            <hr class="my-1" >
                            <div class="form-group row my-0" style="margin-left: 7rem">
                                <div class="icheck-primary d-inline col-sm-1 text-left">
                                    <input type="checkbox" id="status" name="status" value="1" class="form-control"  @if(!empty($userDetail->status)) {{ $userDetail->status == 1 ? 'checked' : ''}}  @endif >
                                    <label for="status">
                                        Enable
                                    </label>
                                </div>
                            </div>
                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <div class="float-left">
                                <a href="{{route('customers.create_step1')}}" class="btn btn-outline-info btn-sm">Previous</a>
                            </div>
                            <div class="float-right">
                                <input type="submit" value="Save and Continue" class="btn btn-success btn-sm">
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
{{--    <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>--}}
    <script src="{{asset('js/bootstrap4-toggle.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/js/main.js')}}"></script>

    <script>
        jQuery(document).ready(function ()
        {
            jQuery('select[name="state"]').on('change',function(){
                var stateID = jQuery(this).val();
                if(stateID)
                {
                    jQuery.ajax({
                        url : '/state/' +stateID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('select[name="lga"]').empty();
                            jQuery.each(data, function(key,value){
                                $('select[name="lga"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }
                else
                {
                    $('select[name="lga"]').empty();
                }
            });
        });
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                width: 185
            });

        });

        // $("input[data-bootstrap-switch]").each(function(){
        //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
        // });

        $('#gender').on('change', function () {
            var action = $(this).prop('checked');
            // alert(action);
            if(action)
            {
                $("input[name='gender']").val('Male');
            }else
            {
                $("input[name='gender']").val('Female');
            }
        });
    </script>

@endsection
