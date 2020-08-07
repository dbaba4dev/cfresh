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
                <h1><i class="fa fa-users-cog"></i> Management users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">users </i> </a> - </li>
                    <li class="active"> all users</li>
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
                                <h3 class="card-title"><i class="fa fa-users-cog"></i> Manage <b>Users</b></h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a role="button" data-toggle="modal" data-target="#addUserModal" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New User</span>
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
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Permission</th>
                                    <th>Edit</th>
                                    <th>Trash</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($admins)>0)
                                    @foreach($admins as $user)
                                        <tr>
                                            <td>
                                                @if(!empty($user->image))
                                                    <img src="{{asset($user->image)}}" alt="" height="50px" width="50px" class="img-circle">
                                                @else
                                                    <img src="{{asset('images/backends_images/admins_images/avatar.png')}}" alt="" height="50px" width="50px" class="img-circle">
                                                @endif

                                            </td>
                                            @if($user->employee_id == 0)
                                                <td>Dauda Baba</td>
                                            @else
                                                <td>{{$user->employee->name}}</td>
                                            @endif
                                            <td>{{$user->username}}</td>
                                            <td>
                                                @if($user->employee_id != 0)
                                                    @if(Auth::id() !== $user->id)
                                                        @if($user->status == 1)
                                                            <a href="{{route('is_admin',['id'=>$user->id])}}" class="btn btn-danger btn-xs"> Remove permissions </a>
                                                        @else
                                                            <a href="{{route('not_admin',['id'=>$user->id])}}" class="btn btn-success btn-xs">Make admin</a>
                                                        @endif
    {{--                                                @else--}}
    {{--                                                    <td></td>--}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->employee_id != 0)
                                                    <a href="{{route('user_admin.edit',['id'=>$user->id])}}" class="fa fa-edit text-success"></a>
                                                @endif
                                            </td>
                                            <td>
                                            @if($user->employee_id != 0)
                                                @if(Auth::id() !== $user->id)
                                                    <a href="{{route('user.deactivated',['id'=>$user->id])}}" class="fa fa-trash text-danger"></a>
                                                @endif
                                            @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <td>
                                        No users added yet!
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

        @include('admin.includes.add_users_modal')

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
