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
                <h1><i class="fa fa-book-open"></i> Coupons </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Coupons </i> </a> - </li>
                    <li class="active">Edit Coupon</li>
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
                        <h5 class="card-title">Edit - <strong>Coupon</strong></h5>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('admin.editCoupon', ['id'=>$coupon->id])}}" method="post" id="editCoupon">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row my-0" >
                                <label for="coupon_code" class="col-sm-2 col-form-label text-right">Coupon Code</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="text" name="coupon_code" id="coupon_code" value="{{$coupon->coupon_code}}" minlength="5" maxlength="15" class="form-control form-control-sm " required>

                                </div>

                                <label for="coupon_code" class="col-sm-2 col-form-label text-right">Customer</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="user_id" id="user_id" class="form-control form-control-sm select2" required>
                                        <option value="" selected>Choose ...</option>
                                        @foreach($users as $customer)
                                            <option value="{{$customer->id}}"
                                                    @if($customer->id == $coupon->user_id)
                                                    selected
                                                @endif
                                            >{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="amount" class="col-sm-2 col-form-label text-right">Amount</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="number" name="amount" id="amount" value="{{$coupon->amount}}" min="1" class="form-control form-control-sm " required>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="amount_type" class="col-sm-2 col-form-label text-right">Amount Type</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm select2" required>
                                        <option value="Percentage" {{$coupon->amount_type == 'Percentage' ? 'selected' : ''}}>Percentage</option>
                                        <option value="Fixed" {{$coupon->amount_type == 'Fixed' ? 'selected' : ''}}>Fixed</option>
                                    </select>
                                </div>

                            </div>
                            <hr class="my-1">
                            <div class="form-group row my-0" >
                                <label for="product_color" class="col-sm-2 col-form-label text-right">Expire Date</label>
                                <div class="col-sm-3 text-left">
                                    <input type="date" id="expire_date" name="expire_date" value="{{$coupon->expire_date}}" required class="form-control">
                                </div>
                            </div>
                            <hr class="my-1" >
                            <div class="form-group row my-0" style="margin-left: 7rem">
                                <div class="icheck-primary d-inline col-sm-1 text-left">
                                    <input type="checkbox" id="status" name="status" value="{{$coupon->status}}" class="form-control" {{$coupon->status == 1 ? 'checked' : 0}}>
                                    <label for="status">
                                        Enable
                                    </label>
                                </div>
                            </div>
                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Add Coupon" class="btn btn-success">
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

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $("#view_batches").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });

        $('#status').on('click', function () {
            if((this).checked)
            {
                $(this).val(1);

            }else
            {
               $(this).val(0);
            }

        })


    </script>

    <script>
        $('#finished_prd').validate({
            rules:{
                product_type:{
                    required: true
                },
                quantity:{
                    required: true,
                    number:true
                },
                store_keeper:{
                    required: true
                },

            },
            errorClass: 'help-inline',
            errorElement: 'span',
            highlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
        });
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
