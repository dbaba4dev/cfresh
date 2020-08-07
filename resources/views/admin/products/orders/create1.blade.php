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
                <h1>Products Orders </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Products </i> </a> - </li>
                    <li class="active"> Orders</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        @include('admin.includes.errors')
        <form action="{{route('order.store')}}" method="post">
            {{csrf_field()}}

            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title"><i class="fa fa-cart-plus"></i> New Order</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">Customer</label>
                                <select class="form-control-sm select2" name="customer_id" id="customer_id" style="width: 100%;">
                                    <option value="" selected disabled>Choose Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
{{--                                <input type="hidden" id="selected_material_val" name="selected_material_val">--}}
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">
                                    Sales Rep.
                                </label>
                                <select class="form-control-sm select2" name="employee_id" id="employee_id" style="width: 100%;">
                                    <option value="" selected disabled>Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                {{--                                <input class="form-control form-control-sm" id="preform_weight" name="preform_weight" required  type="text">--}}

                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">
                                    Case Type
                                </label>
                                <select class="form-control-sm select2" name="box_id" id="box_id" style="width: 100%;">
                                    <option value="" selected disabled>Select Case type</option>
                                    @foreach($cases as $case)
                                        <option value="{{$case->id}}">{{$case->case}}</option>
                                    @endforeach
                                </select>
                                {{--                                <input class="form-control form-control-sm" id="preform_weight" name="preform_weight" required  type="text">--}}

                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">
                                    Quantity
                                </label>
                                <input class="form-control form-control-sm" id="quantity" name="quantity"   type="number">
                                </input>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <button class="btn btn-info btn-sm" id="btn-add" type="submit" value="add">
                        Make Order
                    </button>
                </div>
            </div>
        </form>

    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(function () {
            $("#users_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        // $("select[name='raw_material']").change(function(){
        //     console.log('I have Changed');
        //     var $mat = $(this).val();
        //     console.log($mat);
        //     if($mat == 1)
        //     {
        //         $('#mat_val').text(' Weight of Bags (kg)');
        //     }else if($mat == 2)
        //     {
        //         $('#mat_val').text(' No. of Caps');
        //     }else if($mat == 3)
        //     {
        //         $('#mat_val').text(' No. of Labels');
        //     }
        //
        //     // $('#selected_material_val').val($material);
        //
        // });
    </script>
@endsection
