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
                <h1><i class="fa fa-store"></i> Customers </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                                        <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> All Customers</li>
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
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <strong><i class="fa fa-store-alt"></i> All</strong> - Registered Customers
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="store_list" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Name </th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Lga</th>
                                        <th>Phone</th>
                                        <th>Balance</th>
                                        <th>Sale Rep.</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($customer->created_at)->toFormattedDateString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($customer->created_at)->format('H:i:s A')}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->address}}</td>
                                           <td>{{$customer->state->name}}</td>
                                            <td>{{$customer->lga->name}}</td>
                                            <td>{{$customer->mobile}}</td>
                                            <td>{{$customer->old_balance}}</td>
                                            <td>{{$customer->vendor}}</td>

                                            @if($customer->status == 1)
                                                <td ><strong>Active</strong></td>
                                            @else
                                                <td ><strong>Inctive</strong></td>
                                            @endif
                                            <td align="center">
                                                <a role="button" href="{{route('customers.create_step2', ['id'=>$customer->id])}}"  class="fa fa-edit text-success"></a> |
                                                <a href="" class="fa fa-trash text-danger"></a>
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
            $("#store_list").DataTable({
                "responsive": true,
                "autoWidth": false,

                "order": [[ 0, "desc" ], [ 1, "desc" ]]
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

@endsection
