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
                <h1><i class="fa fa-book-open"></i>Edit CMS Pages </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">CMS Pages </i> </a> - </li>
                    <li class="active">Edit CMS Page</li>
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
                        <h5 class="card-title">
                            <span style="color: blue"><i class="fa fa-clipboard-list"></i></span> Edit - <strong>{{$cmsPage->title}} Page</strong></h5>
                    </div>
                    <form action="{{route('admin.editCms', ['id'=>$cmsPage->id])}}" method="post" id="editCms_page">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row my-0" >
                                <label for="title" class="col-sm-2 col-form-label text-right">Title</label>
                                <div class="col-sm-6" style="margin-top: 0.3rem">
                                    <input type="text" name="title" id="title" class="form-control form-control-sm " value="{{$cmsPage->title}}" required>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="sub_title" class="col-sm-2 col-form-label text-right">Sub Title</label>
                                <div class="col-sm-4" style="margin-top: 0.3rem">
                                    <input type="text" name="sub_title" id="sub_title" class="form-control form-control-sm " value="{{$cmsPage->sub_title}}" >

                                </div>

                            </div>
                            <hr class="my-0">
                            <div class="form-group row my-0" >
                                <label for="url" class="col-sm-2 col-form-label text-right">CMS Page URL</label>
                                <div class="col-sm-4" style="margin-top: 0.3rem">
                                    <input type="text" name="url" id="url" class="form-control form-control-sm " value="{{$cmsPage->url}}" required>

                                </div>

                            </div>
                            <hr class="my-0">
                            <div class="form-group row my-0" >
                                <label for="description" class="col-sm-2 col-form-label text-right">Description</label>
                                <div class="col-sm-8" style="margin-top: 0.3rem">
                                    <textarea name="description" id="description" rows="5" class="form-control form-control-sm "  required>{{$cmsPage->description}}</textarea>

                                </div>

                            </div>

                            <hr class="my-1" >
                            <div class="form-group row my-0" style="margin-left: 7rem">
                                <div class="icheck-primary d-inline col-sm-1 text-left">
                                    <input type="checkbox" id="status" name="status" value="1" class="form-control"  {{$cmsPage->status == 1 ? 'checked' : null}}>
                                    <label for="status">
                                        Enable
                                    </label>
                                </div>
                            </div>
                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Update CMS Page" class="btn btn-info">
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


    </script>

    <script>
        $('#finished_prd').validate({
            rules:{
                product_type:{
                    required: true
                },
                quantity:{
                    required: true,
                    number:true
                },
                store_keeper:{
                    required: true
                },

            },
            errorClass: 'help-inline',
            errorElement: 'span',
            highlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('error');
            },
            unhighlight:function (element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('error');
                $(element).parents('.form-group').addClass('success');
            }
        });
    </script>

    <script src="{{asset('js/scripts.js')}}"></script>



@endsection
