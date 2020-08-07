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

                <h1><i class="fa fa-cart-plus"></i> Customers' Orders </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    {{--                    <li><a href="#">Inventory </i> </a> - </li>--}}
                    <li class="active"> Orders</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2 " style="margin-top: -1rem; margin-bottom: 0.5rem">
                <a role="button" href="{{route('order.create')}}"  class="float-right">
                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Order</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <i class="fa fa-cart-plus"></i>
                        <strong>Orders</strong> - History
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="preforms_list" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Customer</th>
                                        <th>Quantities </th>
                                        <th>Case Type</th>
                                        <th>Sales Rep.</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($order->created_at)->format('h:i A')}}</td>
                                            <td>{{$order->customer->name}}</td>
                                            <td>{{$order->quantity}}</td>
                                            <td>{{$order->box->case}}</td>
                                            <td>{{$order->employee->name}}</td>

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
{{--        @include('admin.includes.move_material_modal')--}}

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
            $("#preforms_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $("#caps_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $("#labels_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        $("select[name='raw_material']").change(function(){
            console.log('I have Changed');
            var $mat = $(this).val();
            console.log($mat);
            if($mat == 1)
            {
                $('#material').text(' Preform Weight (g)');
            }else if($mat == 2)
            {
                $('#material').text(' Cap Weight (g)');
            }else if($mat == 3)
            {
                $('#material').text(' Label Weight (g)');
            }

            // $('#selected_material_val').val($material);

        });

        $('#bags').focus(function () {
            var $stock_bag = parseInt($('#total_bags').val());
            var $bags = parseInt($(this).val());
            if($bags > $stock_bag) {
                console.log('Input ' + $bags);
                console.log('amount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",true);
                $('.notification').removeAttr('hidden');
                $('#notification').text(' This number is more than available bags in stock');
                $('.notification').delay(6000).slideUp(300).html(ul);

            }else
            {
                console.log('FInput ' + $bags);
                console.log('Famount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",false);
            }

        });

        $('#bags').blur(function () {
            var $stock_bag = parseInt($('#total_bags').val());
            var $bags = parseInt($(this).val());
            if($bags > $stock_bag) {
                console.log('Input ' + $bags);
                console.log('amount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",true);
                $('.notification').removeAttr('hidden');
                $('#notification').text(' This number is more than available bags in stock');
                $('.notification').delay(6000).slideUp(300).html(ul);

            }else
            {
                console.log('FInput ' + $bags);
                console.log('Famount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",false);
            }

        });

    </script>
@endsection
