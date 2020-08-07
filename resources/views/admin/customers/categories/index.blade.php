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
                <h1><i class="fa fa-users"></i> Customers </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Customers </i> </a> - </li>
                    <li class="active"> Customers Categories</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
{{--            <div class="col-sm-1"></div>--}}
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-user-clock"></i> Customer  <b>Categories</b> </h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a role="button" data-toggle="modal" data-target="#addCustomerCategoryModal" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Category</span>
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
                                    <th>Name</th>
                                    <th>Discount(%)</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($categories)>0)
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->discount}}</td>
                                            <td>{{\Carbon\Carbon::parse($category->created_at)->format('jS  F Y h:i:s A')}}</td>
                                            <td>{{\Carbon\Carbon::parse($category->updated_at)->format('jS  F Y h:i:s A')}}</td>
                                            <td align="center"><a role="button"  class="editbtn fa fa-edit text-success" id="{{$category->id}}"></a></td>
                                            <td align="center"><a href="{{route('customers.category.delete',['id'=>$category->id])}}" class="fa fa-trash text-danger"></a></td>

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
{{--            <div class="col-sm-1"></div>--}}
        </div>

        @include('admin.includes.add_customer_category_modal')
{{--        @include('admin.includes.add_category_modal')--}}
        @include('admin.includes.edit_customer_category_modal')

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
