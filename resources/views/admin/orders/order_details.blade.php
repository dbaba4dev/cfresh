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
                <h1> Order #{{$orderDetails->id}} </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Orders </i> </a> - </li>
                    <li class="active"> View Orders</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body bg-light">
                        <h5 class="card-title m-b-0" >Order Details</h5>
                        <div class="float-right"><a href="{{route('admin.orderHistory', ['user_id'=>$orderDetails->user_id])}}" class="btn btn-outline-success btn-sm">View Order History</a></div>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Order Date</td>
                            <td >{{\Carbon\Carbon::parse($orderDetails->created_at)->toFormattedDateString()}} {{\Carbon\Carbon::parse($orderDetails->created_at)->format('h:i A')}}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td class="text-primary">{{$orderDetails->order_status}}</td>

                        </tr>
                    @if($orderDetails->order_status == 'Paid')
                        <tr>
                            <td>Amount Paid</td>
                            <td> <strong>&#8358 {{number_format($orderDetails->amount_paid, 2)}}</strong> </td>

                        </tr>

                        <tr>
                            <td>Balance</td>
                            @if($orderDetails->balance < 0)
                                <td> <strong>&#8358 {{number_format($orderDetails->balance, 2)}}</strong> </td>
                            @else
                                <td class="text-danger"> <strong>&#8358 {{number_format($orderDetails->balance, 2)}}</strong> </td>
                            @endif
                        </tr>
                     @endif
                        </tbody>
                    </table>
                </div>
                <!-- accoridan part -->
                <div class="accordion" id="billing_address">
                    <div class="card m-b-0">
                        <div class="card-header bg-light" id="headingBilling">
                            <h5 class="mb-0">
                                <a  data-toggle="collapse" data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Billing Address</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseBilling" class="collapse show" aria-labelledby="headingBilling" data-parent="#billing_address">
                            <div class="card-body">
                                {{$billingsDetails->name}} <br>
                                {{$billingsDetails->address}} <br>
                                {{$billingsDetails->lga_id}} <br>
                                {{$billingsDetails->state->name}} <br>
                                {{$billingsDetails->pincode}} <br>
                                {{$billingsDetails->mobile}} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body bg-light">
                        <h5 class="card-title m-b-0 ">Customer Details</h5>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td >{{$orderDetails->name}}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td >{{$orderDetails->user_email}}</td>

                        </tr>
                        <tr>
                            <td>New Balance</td>
                            @if($orderDetails->order_status == 'Delivered')
                                <td class="text-danger"> <strong>&#8358 {{number_format($orderDetails->grand_total, 2)}}</strong> </td>
                            @else
                                <td class="text-danger"> <strong>&#8358 {{number_format($user->old_balance, 2)}}</strong> </td>
                            @endif

                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="accordion" id="orders_status" style="margin-bottom: 1.2rem">
                    <div class="card m-b-0">
                        <div class="card-header bg-light" id="headingorder_status">
                            <h5 class="mb-0">
                                <a  data-toggle="collapse" data-target="#collapseOrder_status" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Update Order Status</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOrder_status" class="collapse show" aria-labelledby="headingorder_status" data-parent="#orders_status">
                            <div class="card-body">
                                <form action="{{route('admin.updateOrderStatus')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                                    <input type="hidden" name="user_id" value="{{$orderDetails->user_id}}">
                                    <div class="form-group row">
                                        <div class="col-sm-6" >
                                            <select name="order_status" id="order_status" class="select2 form-control form-control-sm">
                                                <option value="New" {{$orderDetails->order_status == 'New' ? 'selected' : ''}}>New</option>
                                                <option value="Pending" {{$orderDetails->order_status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                                <option value="Cancelled" {{$orderDetails->order_status == 'Cancelled' ? 'selected' : ''}}>Cancelled</option>
                                                <option value="In Process" {{$orderDetails->order_status == 'In Process' ? 'selected' : ''}}>In Process</option>
                                                <option value="Shipped" {{$orderDetails->order_status == 'Shipped' ? 'selected' : ''}}>Shipped</option>
                                                <option value="Delivered" {{$orderDetails->order_status == 'Delivered' ? 'selected' : ''}}>Delivered</option>
                                                <option value="Paid" {{$orderDetails->order_status == 'Paid' ? 'selected' : ''}}>Paid</option>
                                            </select>
                                        </div>
{{--                                        @if($orderDetails->order_status == 'Paid')--}}
                                        <div class="col-sm-6 paid">
                                            <input type="text" name="amount_paid" id="amount_paid" class="form-control form-control-sm" placeholder="Amount Paid" required>
                                        </div>
{{--                                        @endif--}}
                                    </div>
                                    <div class="form-group row">
{{--                                        @if($orderDetails->order_status == 'Paid')--}}
                                        <div class="col-sm-6 paid" >
                                            <select name="employee_id" id="employee_id" class="select2 form-control form-control-sm" required>
                                                <option value="" selected disabled>Received By</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                        @endif--}}
                                        <div class="col-sm-6">
                                            @if($orderDetails->order_status != 'Paid')
                                                <input type="submit" value="Update Status" id="update_btn" class="btn btn-success btn-sm">
                                            @endif
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- accoridan part -->
                <div class="accordion" id="shipping_address">
                    <div class="card m-b-0">
                        <div class="card-header bg-light" id="headingShipping">
                            <h5 class="mb-0">
                                <a  data-toggle="collapse" data-target="#collapseShipping" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Shipping Address</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseShipping" class="collapse show" aria-labelledby="headingShipping" data-parent="#shipping_address">
                            <div class="card-body">
                                @if(!empty($shippingDetails))
                                    {{$shippingDetails->name}} <br>
                                    {{$shippingDetails->address}} <br>
                                    {{$shippingDetails->lga_id}} <br>
                                    {{$shippingDetails->state->name}} <br>
                                    {{$shippingDetails->pincode}} <br>
                                    {{$shippingDetails->mobile}} <br>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="shipping_address">
                    <div class="card m-b-0">
                        <div class="card-header bg-light" id="headingShipping">
                            <h5 class="mb-0">
                                <a  data-toggle="collapse" data-target="#collapseShipping" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Summary</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseShipping" class="collapse show" aria-labelledby="headingShipping" data-parent="#shipping_address">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="orders_list" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderDetails->orders as $order)
                                            <tr>
                                                <td>{{\Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                                                <td>{{\Carbon\Carbon::parse($order->created_at)->format('h:i A')}}</td>
                                                <td>{{$order->product_name}}</td>
                                                <td>{{$order->product_price}}</td>
                                                <td>{{$order->product_qty}}</td>
                                                <td>{{$order->product_qty*$order->product_price}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
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

            $("#orders_list").DataTable({
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

        });

        $(document).ready(function () {
            $('.paid').hide();
            $('#order_status').change(function () {
                var order_status = $(this).val();
                if(order_status == 'Paid')
                {
                    $('.paid').show();
                    $('#amount_paid').attr('required', true);
                    $('#employee_id').attr('required', true);
                }else
                {
                    $('.paid').hide();
                    $('#amount_paid').attr('required', false);
                    $('#employee_id').attr('required', false);
                }
            });
        })
    </script>
@endsection
