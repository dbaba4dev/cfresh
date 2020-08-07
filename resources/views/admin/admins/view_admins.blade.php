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
                <h1><i class="fa fa-user-cog"></i> Admins Management </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Admins </i> </a> - </li>
                    <li class="active"> View Admins</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @include('admin.includes.alert-msg')
                <div class="card">
                    <div class="card-header p-2 bg-gradient-info">

                        <h5 class="card-title"><i class="fa fa-users"></i> Admins</h5>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="view_admins" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                    <th>Created On</th>
                                    <th>Updated On</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <?php if($admin->type == 'Admin')
                                    {
                                        $roles = 'All';
                                    }else
                                    {
                                        $roles = '';
                                        if ($admin->employees_access!=0)
                                        {
                                            $roles .= 'Categories, ';
                                        }
                                        if ($admin->products_access!=0)
                                        {
                                            $roles .= 'Products, ';
                                        }
                                        if ($admin->orders_access!=0)
                                        {
                                            $roles .= 'Orders, ';
                                        }
                                        if ($admin->users_access!=0)
                                        {
                                            $roles .= 'Customers, ';
                                        }
	
	 									if ($admin->finance_access!=0)
                                        {
                                            $roles .= 'Finance, ';
                                        }
                                        if ($admin->operation_access!=0)
                                        {
                                            $roles .= 'Operations, ';
                                        }                                    
	

                                        if ($admin->inventories_view_access!=0 ||$admin->inventories_manage_access!=0)
                                        {
                                            $roles .= 'inventories, ';
                                        }
                                        if ($admin->store_move_access!=0 ||$admin->store_view_access!=0)
                                        {
                                            $roles .= 'Store, ';
                                        }

                                    }
                                    ?>
                                    <tr>
                                        <td>{{$admin->id}}</td>
                                        <td>{{$admin->employee->name}}</td>
                                        <td>{{$admin->username}}</td>
                                        <td>{{$admin->type}}</td>
                                        <td>{{$roles}}</td>
                                        <td>
                                            @if($admin->status == 1)
                                                <span style="color: green">Active</span>
                                            @else
                                                <span style="color: red">Inactive</span>
                                            @endif
                                        </td>

                                        <td>{{\Carbon\Carbon::parse($admin->created_at)->toFormattedDateString()}} - {{\Carbon\Carbon::parse($admin->created_at)->format('h:i A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($admin->updated_at)->toFormattedDateString()}} - {{\Carbon\Carbon::parse($admin->updated_at)->format('h:i A')}}</td>
                                        <td>
                                            <a href="{{route('editAdmin', ['id'=>$admin->id])}}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{--        @include('admin.includes.add_inventory_modal')--}}
        @include('admin.includes.errors')
        @include('admin.includes.move_material_modal')

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
            $("#view_admins").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
@endsection
