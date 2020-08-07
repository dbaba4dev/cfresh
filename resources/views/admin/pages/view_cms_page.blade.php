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
                <h1><i class="fa fa-gift"></i> CMS Pages </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">CMS Pages </i> </a> - </li>
                    <li class="active"> View CMS Page</li>
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
                <div class="card">
                    @include('frontend.includes.msgs')
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <strong><i class="fa fa-gift"></i> CMS Pages</strong> - Available CMS Pages
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="cms_list" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Page ID</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>URL </th>
                                        <th>Status</th>
                                        <th>Created on</th>
                                        <th>Description</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cmsPages as $page)
                                        <tr>
                                            <td>{{$page->id}}</td>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->sub_title}} </td>
                                            <td>{{$page->url}}</td>
                                            <td>{{$page->status == 1 ? 'Active' : 'Not Active'}}</td>
                                            <td>{{\Carbon\Carbon::parse($page->created_at)->format('h:i A')}}</td>
                                            <td>{{$page->description}}</td>
                                            <td class="text-center">
                                                <a data-toggle="modal" href="#viewPageDetailModal{{$page->id}}" class="detailBtn btn btn-outline-info btn-xs">
                                                    View
                                                </a>

                                                <a href="{{url('admin/cms/update/'.$page->id)}}" class="detailBtn btn btn-success btn-xs">Edit</a>
                                                <a href="{{url('admin/cms/delete/'.$page->id)}}" class="detailBtn btn btn-outline-danger btn-xs">Delete</a>


                                                <!-- Add Task Modal Form HTML -->
                                                <div class="modal hide" id="viewPageDetailModal{{$page->id}}" data-backdrop="false">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h6 >
                                                                    {{$page->title}} Full Details
                                                                </h6>
                                                                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                                                    ×
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table id="view_batches" class="table table-striped table-bordered table-sm" style="margin-left: 2.5rem; font-size: 0.8rem; width: 80%">
                                                                        <tbody class="align-content-center">
                                                                        <tr >
                                                                            <td><strong>Title:</strong></td>
                                                                            <td>{{$page->title}}</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><strong>Sub Title</strong></td>
                                                                            <td>{{$page->sub_title}}</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><strong>URL:</strong></td>
                                                                            <td>{{$page->url}}</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><strong>Status:</strong></td>
                                                                            <td>{{$page->status == 1 ? 'Active' : 'Inactive'}}</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><strong>Created on:</strong></td>
                                                                            <td>{{\Carbon\Carbon::parse($page->created_at)->format('h:i A')}}</td>
                                                                        </tr>
                                                                        <tr >
                                                                            <td><strong>Description:</strong></td>
                                                                            <td>{{$page->description}}</td>
                                                                        </tr>

                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>

{{--                @include('admin.includes.view_page_detail_modal')--}}


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
            $("#cms_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        $(document).on('click', '.delete_coupon', function (e) {
            var id = $(this).attr('rel');
            // var deleteFunction = $(this).attr('rel1');
            // alert(deleteFunction);
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record again!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    window.location.href = '/admin/coupons/delete/'+id;
                });

        })
    </script>
@endsection
