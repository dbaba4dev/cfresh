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
                <h1><i class="fa fa-users-cog"></i> Customers users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">users </i> </a> - </li>
                    <li class="active"> Registered users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content" style="font-size: 0.8rem">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-users-cog"></i> Customers <b>Users</b></h3>
                            </div>
                            <div class="col-sm-6 ">
{{--                                <a role="button" data-toggle="modal" data-target="#addUserModal" class="float-right">--}}
{{--                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> Users</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_list" class="table table-striped table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>LGA</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Registered on</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{!empty($user->lga) ? $user->lga->name : ''}}</td>
                                        <td>{{!empty($user->state) ? $user->state->name : ''}}</td>
                                        <td>{{$user->pincode}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->email}}</td>
                                        <td >
                                            @if($user->status == 1)
                                                <span style="color: green">Active</span>
                                            @else
                                                <span style="color: red">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($user->created_at)->toFormattedDateString()}}</td>

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
