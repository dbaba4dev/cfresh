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
                <h1>Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home </a> - </li>
{{--                    <li><a href="#">Employees </i> </a> - </li>--}}
                    <li class="active">Settings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px darkseagreen">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="card card-info">
                    <form action="{{route('settings.commission.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">Commission Factor</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" name="commission_factor" class="form-control" value="{{$setting->commission_factor}}">
                            </div>
                            <!-- /input-group -->
                        </div>
                        <!-- /.card-body -->

                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <!-- Input addon -->
                <div class="card card-info">
                    <form action="{{route('settings.info.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-header bg-gradient-info">
                            <h3 class="card-title">Site Settings</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Site Name</span>
                                        </div>
                                        <input type="text" class="form-control" name="site_name" value="{{$setting->site_name}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="contact_email" placeholder="Email" value="{{$setting->contact_email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address</span>
                                        </div>
                                        <input type="text" class="form-control" name="contact_address" value="{{$setting->contact_address}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="tel" class="form-control" name="contact_number" value="{{$setting->contact_number}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button class="btn btn-info" id="btn-add" type="submit" >
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('app/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection
