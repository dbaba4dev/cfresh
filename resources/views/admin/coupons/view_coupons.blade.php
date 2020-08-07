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
                <h1><i class="fa fa-gift"></i> Coupons </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Coupons </i> </a> - </li>
                    <li class="active"> View Coupons</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('frontend.includes.msgs')
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <strong><i class="fa fa-gift"></i> Coupons</strong> - Available Coupons
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="coupons_list" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Coupons ID</th>
                                        <th>Coupons Code</th>
                                        <th>Customer </th>
                                        <th>Amount </th>
                                        <th>Amount Type</th>
                                        <th>Expire Date</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{$coupon->id}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{\App\User::where('id',$coupon->user_id)->first()->name}}</td>
                                            <td>{{$coupon->amount}} <?php if ($coupon->amount_type == 'Percentage'){echo '%'; }else{ echo '&#8358';}   ?> </td>
                                            <td>{{$coupon->amount_type}}</td>
                                            <td>{{$coupon->expire_date}}</td>
                                            <td>{{\Carbon\Carbon::parse($coupon->created_at)->format('h:i A')}}</td>
                                            <td>{{$coupon->status == 1 ? 'Active' : 'Not Active'}}</td>
                                            <td class="text-center">
                                                <a href="{{route('admin.editCoupon', ['id'=>$coupon->id])}}" role="button" class="btn btn-success btn-sm">Edit</a> |
                                                <a rel="{{$coupon->id}}" href="javascript:"  id="delete_coupon" role="button" class="delete_coupon btn btn-danger btn-sm">Delete</a>
                                                {{--                                                    <a href="{{route('admin.deleteCoupon', ['id'=>$coupon->id])}}" id="delete_coupon" role="button" class="delete_coupon btn btn-danger btn-sm">Delete</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>

        {{--        @include('admin.includes.add_inventory_modal')--}}
        @include('admin.includes.errors')
        @include('admin.includes.move_material_modal')

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
            $("#coupons_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        $(document).on('click', '.delete_coupon', function (e) {
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
                    window.location.href = '/admin/coupons/delete/'+id;
                });

        })
    </script>
@endsection
