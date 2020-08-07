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
                <h1>User's Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home </a> - </li>
                    <li class="active">   My profile </li>
{{--                    <li class="active">Edit user's profile</li>--}}
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-center">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{asset($admin->employee->profile->avatar)}}"
                                     alt="User profile picture">

                                <h3 class="profile-username text-center">{{$admin->employee->name}}</h3>

                                <p class="text-muted text-center">Software Engineer</p>
                            </div>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$admin->employee->profile->address}}</p>

                            <hr>

                            <strong><i class="fas fa-phone mr-1"></i> Telephone</strong>

                            <p>{{$admin->employee->profile->phone}}</p>
                            (Email: {{$admin->username}})


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#account_history" data-toggle="tab">Account history</a></li>
                                <li class="nav-item"><a class="nav-link" href="#queries" data-toggle="tab">Queries</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                   {{--Profile Contents Here--}}
                                    <form action="{{route('user.profile.update',['id'=>$admin->id])}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{$admin->employee->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input type="password" name="password" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="image">Upload Picture</label>
                                                        <input type="file" name="avatar" >
                                                        <p class="help-block">upload small sized image passport</p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" value="{{$admin->employee->profile->address}}" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="tel" name="phone" value="{{$admin->employee->profile->phone}}" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <button class="btn btn-success" type="submit">
                                                        Update profile
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="account_history">
                                    {{--account_history Info heare--}}
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="queries">
                                    {{--Queries Info heare--}}

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        {{--<div class="row">
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{asset(Auth::user()->profile->avatar)}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                        <p class="text-muted text-center">Software Engineer</p>

                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-phone margin-r-5"></i>{{Auth::user()->profile->phone}}</strong>

                        <p class="text-muted">
                            ({{Auth::user()->email}})
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">{{Auth::user()->profile->address}}</p>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-9">
                @include('includes.errors')
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit your profile</h3>
                    </div>
                    <form action="{{route('user.profile.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Upload Picture</label>
                                        <input type="file" name="avatar" >
                                        <p class="help-block">upload small sized image passport</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{$user->profile->address}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" value="{{$user->profile->phone}}" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                        Update profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>--}}
    </section>
@endsection
