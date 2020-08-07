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
                <h1>Management users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">users </i> </a> - </li>
                    <li class="active"> Edit user</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @include('admin.includes.errors')
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title">Edit <b>user</b>'s profile</h3>
                            </div>
                            <div class="col-sm-6 ">

                            </div>
                        </div>
                    </div>
                    <form action="{{route('user_admin.edit',['id'=>$user->id])}}" method="post" id="Update_adminUser" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row my-0" >
                                <label for="coupon_code" class="col-sm-2 col-form-label text-right">Name</label>
                                <div class="col-sm-4" style="margin-top: 0.3rem">
                                    <select name="employee_id" id="employee_id" class="form-control form-control-sm select2">
                                        <option value="">Select</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}"
                                            {{$user->employee_id == $employee->id ? 'selected' : ''}}
                                            >{{$employee->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="coupon_code" class="col-sm-2 col-form-label text-right">Username</label>
                                <div class="col-sm-4" style="margin-top: 0.3rem">
                                    <input type="text" name="username" id="username" class="form-control form-control-sm " value="{{$user->username}}" >

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="coupon_code" class="col-sm-2 col-form-label text-right">New Password</label>
                                <div class="col-sm-4" style="margin-top: 0.3rem">
                                    <input type="password" name="password" id="password" class="form-control form-control-sm " >

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="action" class="col-sm-2 col-form-label text-right">File upload input</label>
                                <div class="col-sm-3 uploader" id="uniform-undefined">
                                    <input type="file"  id="image" name="image" class="form-control-file">
                                </div>
                                @if(!empty($user->image))
                                    <div class="col-sm-2 text-left">
                                        <input type="hidden" name="current_image" value="{{$user->image}}">
                                        <img src="{{asset($user->image)}}" alt="" height="50px" width="50px" class="img-circle"> |
                                        <a href="{{route('admin.deleteProductImage',['id'=>$user->id])}}">Delete</a>
                                    </div>
                                @endif
                            </div>
                            <hr class="my-1">

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Update User" class="btn btn-success">
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

    </section>
@endsection
@section('scripts')

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

        });


    </script>


    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
