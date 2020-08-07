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
                <h1><i class="fa fa-user-lock"></i> Deactivated users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i>  Home</a> - </li>
                    <li><a href="#">users</a> - </li>
                    <li class="active">all users</li>
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
                                <h3 class="card-title"><i class="fa fa-users-cog"></i>  Manage <b>Users</b></h3>
                            </div>
                            <div class="col-sm-6 ">

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
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Restore</th>
                                    <th>Delete</th>
{{--                                    <th>Trash</th>--}}
                                </tr>
                                </thead>
                                <tbody>
{{--                                @if(count($users)>0)--}}
                                    @foreach($users as $user)
                                        <tr>
                                            <td><img src="{{asset($user->image)}}" alt="" height="50px" width="50px" class="img-circle"></td>
{{--                                            <td width="20%"><img src="{{asset(\App\Profile::where('user_id',$user->id)->onlyTrashed()->first()->avatar)}}" alt="" height="50px" width="50px" class="img-circle"></td>--}}
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->employee->name}}</td>
                                            <td align="center" width="10%"><a href="{{route('user.restore',['id'=>$user->id])}}" class="fa fa-share text-success"></a></td>
                                            <td align="center" width="10%"><a href="{{route('user.delete',['id'=>$user->id])}}" class="fa fa-trash text-danger"></a></td>
                                        </tr>
                                    @endforeach
{{--                                @else--}}
{{--                                    <td>--}}
{{--                                        No Deactivated users in the trash can--}}
{{--                                    </td>--}}


{{--                                @endif--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

{{--        @include('admin.includes.add_users_modal')--}}

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
