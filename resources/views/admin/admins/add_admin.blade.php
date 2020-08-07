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
                    <li class="active">Add Admins</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        {{--                       <span class="icon"><i class=""></i></span>--}}
                        <h5 class="card-title"><i class="fa fa-users"></i> Add - <strong>Admins</strong></h5>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('addAdmin')}}" method="post" id="addAdmin">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row my-0" >
                                <label for="amount_type" class="col-sm-1 col-form-label text-right">Employee</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="employee_id" id="employee_id" class="form-control form-control-sm select2" required>
                                        <option value="0" selected>Select employee name </option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                 <span class="col-sm-2 col-form-label text-right">Not on the list? Add </span>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <a href="{{route('employee.create')}}" class="btn btn-info btn-sm">New Employee</a>
                                </div>

                            </div>
                            <hr class="my-1">

                            <div class="form-group row my-0 other-field" >
                                <label for="amount_type" class="col-sm-1 col-form-label text-right">Type</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem; ">
                                    <select name="type" id="type" class="form-control form-control-sm select2" required>
                                         <option value="" selected disabled>Select Type </option>
                                        <option value="Admin">Admin </option>
                                        <option value="Sub Admin">Sub Admin </option>
                                    </select>
                                </div>

                            </div>
                            <hr class="my-1 other-field" >
                            <div class="form-group row my-0 other-field" >
                                <label for="username" class="col-sm-1 col-form-label text-right">Username</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="text" name="username" id="username" class="form-control form-control-sm " required>

                                </div>

                            </div>
                            <hr class="my-0 other-field" >

                            <div class="form-group row my-0 other-field" >
                                <label for="password" class="col-sm-1 col-form-label text-right">Password</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="password" name="password" id="password"  class="form-control form-control-sm " required>

                                </div>

                            </div>
                            <hr class="my-0 other-field">
                            <div class="form-group row other-field " id="access">
                                <label class="col-sm-1  text-right ">Access</label>
                                <div class="panel panel-default border-left border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem">
                                    <div class="panel-heading" >Customers</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="users_view_access" name="users_access" value="1">
                                            <label class="custom-control-label" for="users_view_access">View Only</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="users_edit_access" name="users_access" value="1">
                                            <label class="custom-control-label " for="users_edit_access">Add & Place Order</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="users_full_access" name="users_access" value="1">
                                            <label class="custom-control-label " for="users_full_access">All</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="users_none_access" name="users_access" value="1" checked>
                                            <label class="custom-control-label " for="users_none_access">None</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Employees</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="employees_view_access" name="employees_access" value="1">
                                            <label class="custom-control-label" for="employees_view_access">View Only</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="employees_edit_access" name="employees_access" value="1">
                                            <label class="custom-control-label " for="employees_edit_access">View, Add & Edit</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="employees_full_access" name="employees_access" value="1">
                                            <label class="custom-control-label " for="employees_full_access">All</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="employees_none_access" name="employees_access" value="1" checked>
                                            <label class="custom-control-label " for="employees_none_access">None</label>

                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Products</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="products_view_access" name="products_access" value="1">
                                            <label class="custom-control-label" for="products_view_access">View Only</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="products_edit_access" name="products_access" value="1">
                                            <label class="custom-control-label " for="products_edit_access">View, Add & Edit</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="products_full_access" name="products_access" value="1">
                                            <label class="custom-control-label " for="products_full_access">All</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="products_none_access" name="products_access" value="1" checked>
                                            <label class="custom-control-label " for="products_none_access">None</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Orders</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="orders_view_access" name="orders_access" value="1">
                                            <label class="custom-control-label" for="orders_view_access">View Only</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="orders_edit_access" name="orders_access" value="1">
                                            <label class="custom-control-label " for="orders_edit_access">View, Add & Edit</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="orders_full_access" name="orders_access" value="1">
                                            <label class="custom-control-label " for="orders_full_access">All</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="orders_none_access" name="orders_access" value="1" checked>
                                            <label class="custom-control-label " for="orders_none_access">None</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Inventories</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="inventories_view_access" id="inventories_view_access" value="1">
                                            <label for="inventories_view_access" class="custom-control-label">View Stock</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="inventories_manage_access" id="inventories_manage_access" value="1">
                                            <label for="inventories_manage_access" class="custom-control-label">Manage Raw Material</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Store</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="store_view_access" id="store_view_access" value="1">
                                            <label for="store_view_access" class="custom-control-label">View Store </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="store_move_access" id="store_move_access" value="1">
                                            <label for="store_move_access" class="custom-control-label">Move Product</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="damage_operation_access" id="damage_operation_access" value="1">
                                            <label for="damage_operation_access" class="custom-control-label">Damage Operation</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default border-right" style="margin-top: 1rem; margin-left: 0.8rem; padding-right: 1rem" >
                                    <div class="panel-heading" >Finance</div>
                                    <div class="panel-body" style="font-size: 0.8rem">
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="finance_view_access" name="finance_access" value="1">
                                            <label class="custom-control-label" for="finance_view_access">View Only</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="finance_edit_access" name="finance_access" value="1">
                                            <label class="custom-control-label " for="finance_edit_access">View, Add & Edit</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="finance_full_access" name="finance_access" value="1">
                                            <label class="custom-control-label " for="finance_full_access">All</label>
                                        </div>
                                        <div class="custom-control custom-radio" style="margin: 3px">
                                            <input class="custom-control-input" type="radio" id="finance_none_access" name="finance_access" value="1" checked>
                                            <label class="custom-control-label " for="finance_none_access">None</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-1 other-field" >
                            <div class="form-group row my-0 other-field" style="margin-left: 2rem">
                                <div class="icheck-primary d-inline col-sm-1 text-left">
                                    <input type="checkbox" id="status" name="status" value="1" class="form-control"  checked>
                                    <label for="status">
                                        Enable
                                    </label>
                                </div>
                            </div>
                            <hr class="my-1 " >

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Add Admin" class="btn btn-success">
                        </div>

                    </form>

                </div>
            </div>


        </div>
    </div>

@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $("#view_batches").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });

        $(document).ready(function () {
            $('.other-field').hide();

            $('#employee_id').change(function () {
                var employee = $(this).val();
                if(employee == '0')
                {
                    $('.other-field').hide();
                }else
                {
                    $('.other-field').show();
                }
            });

            $('#access').hide();
            $('#type').change(function () {
                var type = $(this).val();
                if(type != 'Sub Admin')
                {
                    $('#access').hide();
                }else
                {
                    $('#access').show();
                }
            });
			
			 $('#users_view_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='users_access']").val('1');
                }
            });
            $('#users_edit_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='users_access']").val('2');
                }
            });
            $('#users_full_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='users_access']").val('3');
                }
            });
            $('#users_none_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='users_access']").val('0');
                }
            });
			
			
			

            $('#employees_view_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='employees_access']").val('1');
                }
            });
            $('#employees_edit_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='employees_access']").val('2');
                }
            });
            $('#employees_full_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='employees_access']").val('3');
                }
            });
            $('#employees_none_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='employees_access']").val('0');
                }
            });

            $('#products_view_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='products_access']").val('1');
                }
            });
            $('#products_edit_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='products_access']").val('2');
                }
            });
            $('#products_full_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='products_access']").val('3');
                }
            });
            $('#products_none_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='products_access']").val('0');
                }
            });

            $('#orders_view_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='orders_access']").val('1');
                }
            });
            $('#orders_edit_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='orders_access']").val('2');
                }
            });
            $('#orders_full_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='orders_access']").val('3');
                }
            });
            $('#orders_none_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='orders_access']").val('0');
                }
            });

            $('#finance_view_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='finance_access']").val('1');
                }
            });
            $('#finance_edit_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='finance_access']").val('2');
                }
            });
            $('#finance_full_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='finance_access']").val('3');
                }
            });
            $('#finance_none_access').on('click', function () {
                if((this).checked)
                {
                    $("input[name='finance_access']").val('0');
                }
            });

        })

    </script>


    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
