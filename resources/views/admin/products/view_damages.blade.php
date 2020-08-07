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
                <h1><i class="fa fa-arrow-down"></i> Damages </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Operation </i> </a> - </li>
                    <li><a href="#">Damages </i> </a> - </li>
                    <li class="active"> View Damages</li>
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
                        <i class="fa fa-air-freshener"></i> View Damages
                        <div class="float-right" >
                            <form action="{{route('damages.search')}}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                            </form>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="damage_history" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Batch Code</th>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>User</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($damages as $damage)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($damage->created_at)->toDateString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($damage->created_at)->format('H:i:s A')}}</td>
                                            <td>{{$damage->batch}}</td>
                                            <?php
                                            $first_three_cha = (substr($damage->batch,0,3));
                                            if ($first_three_cha == 'PRE'){
                                                $material =  'Preforms';
                                            }
                                            if ($first_three_cha == 'CAP'){
                                                $material =  'Caps';
                                            }
                                            if ($first_three_cha == 'LBL'){
                                                $material =  'Labels';
                                            }
                                            ?>
                                            <td>{{$material}}</td>
                                            <td>{{$damage->quantity}}</td>
                                            <td>&#8358 {{number_format($damage->amount, 2)}}</td>
                                            <td>{{$damage->admin_name}}</td>

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
            $("#damage_history").DataTable({
                "responsive": true,
                "autoWidth": false,
                "aaSorting": [ [0,'desc'], [1,'desc'] ],
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
@endsection
