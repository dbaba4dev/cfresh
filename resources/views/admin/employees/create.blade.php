@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">--}}
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-users"></i> Employees</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Employees </i> </a> - </li>
                    <li class="active"> New Employee</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    @include('admin.includes.errors')
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-user"></i>  New <b>Employees</b></h3>
                            </div>
                            <div class="col-sm-6 ">
{{--                                <a  role="button" href="{{route('employee.create')}}" class="float-right">--}}
{{--                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Employee</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="card-body" style="border: solid 1px #ccc; box-shadow: #0c525d">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="joined">Joined on</label>
                                        <input type="date" name="joined" id="datepicker" class="form-control" >
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{old('address')}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone"  class="form-control" value="{{old('phone')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <select name="bank_id" class="form-control select2" style="width: 100%; height: 100% !important;">
                                            <option value="0" disabled selected="selected"></option>
                                            @if(!empty($banks))
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="address">Account name</label>
                                        <input type="text" name="account_name" class="form-control" value="{{old('account_name')}}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address">Account number</label>
                                        <input type="text" name="account_no" class="form-control" value="{{old('account_no')}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="avatar">Upload picture</label>
                                        <input type="file" name="avatar" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-info" type="submit">
                                        <i class="fa fa-save"> Save Record</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('admin.includes.add_users_modal')

    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
{{--    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>--}}

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });


            $("#users_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });





        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>

@endsection
