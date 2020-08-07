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
                <h1><i class="fa fa-shopping-bag"></i> Batch History </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Batch Histrory </i> </a> - </li>
                    <li class="active"> View Batches</li>
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
                        <strong><i class="fa fa-shopping-bag"></i> Batches</strong> - History
                        <div class="float-right" >
                            <form action="{{route('stocks.history')}}" method="POST" enctype="multipart/form-data">
                                @csrf

{{--                                <div class="container">--}}
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
{{--                                </div>--}}
                            </form>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="batch_history" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Batch Date</th>
                                        <th>Batch Name</th>
                                        <th>Cost</th>
                                        <th>Material</th>
                                        <th>Bags</th>
                                        <th>Wgt/Bags (kg)</th>
                                        <th>Total (kg)</th>
                                        <th>Unit wgt (g)</th>
                                        <th>Total Materials</th>
                                        <th>material/bag</th>
                                        <th>Company</th>
                                        <th>Description</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ViewsPage as $ViewsPages)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($ViewsPages->created_at)->toFormattedDateString()}}</td>
                                            <td>{{ $ViewsPages->batch_name }}</td>
                                            <td>&#8358 {{number_format($ViewsPages->amount, 2)}}</td>
                                            <td>{{$ViewsPages->material}}</td>
                                            <td>{{$ViewsPages->no_bags}}</td>
                                            <td>{{$ViewsPages->kg_per_bags}}</td>
                                            <td>{{$ViewsPages->total_kg}}</td>
                                            <td>{{$ViewsPages->unit_g}}</td>
                                            <td>{{$ViewsPages->tot_materials}}</td>
                                            <td>{{$ViewsPages->no_materials}}</td>
                                            <td>{{$ViewsPages->company}}</td>
                                            <td>{{$ViewsPages->description}}</td>
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
            $("#batch_history").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
@endsection
