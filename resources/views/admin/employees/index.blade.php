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
                <h1><i class="fa fa-users"></i> Employees</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#"> Employees </i> </a> - </li>
                    <li class="active"> Employees</li>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-users-cog"></i> Manage <b>Employees</b></h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a  role="button" href="{{route('employee.create')}}" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Employee</span>
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
                                    <th>Role</th>
                                    <th>Balance</th>
                                    <th>Phone</th>
                                    <th>Detail</th>
                                    <th>Trash</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($employees)>0)
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td align="center" width="15%">
                                                <?php $image = !empty(asset(\App\Profile::where('employee_id', $employee->id)->first()->avatar)) ?
                                                    asset(\App\Profile::where('employee_id', $employee->id)->first()->avatar)  :
                                                    null ?>
                                                @if(!empty($image))
                                                    <img src="{{asset(\App\Profile::where('employee_id', $employee->id)->first()->avatar)}}" alt="" height="50px" width="50px" class="img-circle">
                                                @else
                                                    <img src="{{asset('images/users/avatar.png')}}" alt="" height="50px" width="50px" class="img-circle">
                                                @endif

                                            </td>
                                            <td width="40%">{{$employee->name}}</td>
                                            <td width="20%">
                                                {{$employee->category->name}}
                                            </td>
                                            <td align="center" width="15%">&#8358 {{$employee->balance}}</td>
                                            <td width="10">{{\App\Profile::where('employee_id', $employee->id)->first()->phone}}</td>
                                            <td align="center" width="5%"><a href="{{route('employee.edit',['id'=>$employee->id])}}" class="fa fa-eye text-success"></a></td>
{{--                                            @if(Auth::id() !== $user->id)--}}
                                                <td align="center" width="5%"><a href="{{route('employee.deactivated',['id'=>$employee->id])}}" class="fa fa-trash-alt text-danger"></a></td>
{{--                                            @else--}}
{{--                                                <td></td>--}}
{{--                                            @endif--}}
                                        </tr>
                                    @endforeach
                                @else
                                    <td>
                                        No employee added yet!
                                    </td>


                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
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
