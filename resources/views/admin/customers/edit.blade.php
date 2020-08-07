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
                <h1>Customers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home </a> - </li>
                    <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> Customers Details</li>
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
                            <h3 class="card-title">{{$customer->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-center">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{asset($customer->profile->avatar)}}"
                                     alt="customer profile picture">

{{--                                <h3 class="profile-username text-center">{{$customer->name}}</h3>--}}

                                <p class="text-muted text-center">{{$customer->category->name}}</p>
                            </div>

                            <hr>

                            <strong><i class="fas fa-home mr-1"></i> Company</strong>

                            <p class="text-muted">{{$customer->company}}</p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$customer->profile->address}}</p>

                            <hr>

                            <strong><i class="fas fa-phone mr-1"></i> Telephone</strong>

                            <p>{{$customer->profile->phone}}</p>

                            <hr>

                            <p class="text-muted " >
                                Balance: &#8358 0
{{--                                <span class="text-danger"> <strong>{{!empty(\App\Commission::where('employee_id',$employee->id)->latest('updated_at')->first()->balance)--}}
{{--                            ? \App\Commission::where('employee_id',$employee->id)->latest('updated_at')->first()->balance--}}
{{--                            : 0}}</strong></span>--}}
                            </p>

                            <p class="text-muted " >
                                Credit Limit: {{$customer->credit_limit}}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    @include('admin.includes.errors')
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#account_history" data-toggle="tab">Transaction history</a></li>
{{--                                <li class="nav-item"><a class="nav-link" href="#queries" data-toggle="tab">Queries</a></li>--}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <form action="{{route('customer.profile.update',['id'=>$customer->id])}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{$customer->name}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="category_id">Customer Type</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"
                                                            @if($category->id == $customer->category->id)
                                                            selected
                                                        @endif
                                                    >{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select name="area_id" class="form-control select2" style="width: 100%; height: 100% !important;">
                                                {{--                                                <option value="0" disabled selected="selected"></option>--}}
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}"
                                                            @if($area->id == $customer->area->id)
                                                            selected
                                                        @endif
                                                    >{{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" value="{{$customer->profile->address}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="tel" name="phone"  class="form-control" value="{{$customer->profile->phone}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="avatar">Upload picture</label>
                                            <input type="file" name="avatar" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="joined">Credit limit</label>
                                            <input type="text" name="credit_limit" id="datepicker" class="form-control" value="{{$customer->credit_limit}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category_id">Sales Reps.</label>
                                            <select name="employee_id" id="employee_id" class="form-control">
                                                <option value="" selected disabled>Select Sale Reps.</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}"
                                                            @if($employee->id == $customer->employee->id)
                                                            selected
                                                        @endif
                                                    >{{$employee->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company">Company name</label>
                                            <input type="text" name="company" class="form-control" value="{{$customer->company}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nick_name">Nick name</label>
                                            <input type="text" name="nick_name" class="form-control" value="{{$customer->nick_name}}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="text-center">
                                        <button class="btn btn-success" type="submit">
                                           <i class="fa fa-save"></i> Update Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                            </div>
                            <div class="tab-pane" id="account_history">
                                <!-- The timeline -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="queries">
                                {{--Queries Info heare--}}
                            </div>
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>
@endsection
