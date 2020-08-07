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
                <h1><i class="fa fa-users"></i> Customers </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> Customers Locations</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-directions"></i> Customers  <b>Locations</b> </h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a role="button" data-toggle="modal" data-target="#addLocationModal" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Location</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_list" class="table table-striped table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($areas)>0)
                                    @foreach($areas as $area)
                                        <tr>
                                            <td>{{$area->name}}</td>
                                            <td>{{\Carbon\Carbon::parse($area->created_at)->format('jS  F Y h:i:s A')}}</td>
                                            <td>{{\Carbon\Carbon::parse($area->updated_at)->format('jS  F Y h:i:s A')}}</td>
                                            <td align="center"><a role="button"  class="editbtn fa fa-edit text-success" id="{{$area->id}}"></a></td>
                                            <td align="center"><a href="{{route('areas.delete',['id'=>$area->id])}}" class="fa fa-trash text-danger"></a></td>

                                        </tr>
                                    @endforeach
                                @else
                                    <td>
                                        No Area added yet!
                                    </td>


                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

        @include('admin.includes.add_location_modal')
        @include('admin.includes.edit_location_modal')

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

@endsection
