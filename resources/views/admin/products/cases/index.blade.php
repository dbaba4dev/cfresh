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
                <h1><i class="fa fa-project-diagram"></i> Products Cases </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Products </i> </a> - </li>
                    <li class="active">Product Type</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><i class="fa fa-boxes"></i> Product Type</h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a href="{{route('case.create')}}" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Case</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_list" class="table table-striped table-bordered table-sm" style="font-size: 0.8rem">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Cases</th>
                                    <th>Price (&#8358)</th>
                                    <th>Preform Weight</th>
                                    <th>Cap Weight</th>
                                    <th>Label Weight</th>
{{--                                    <th>No. Caps/Bag</th>--}}
{{--                                    <th>No. Labels/Bag</th>--}}
                                    <th>Description</th>
                                    <th></th>
{{--                                    <th></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($cases)>0)
                                    @foreach($cases as $case)
                                        <tr>
                                            <td class="text-center">
                                                @if(!empty($case->image))
                                                    <img src="{{asset('images/backends_images/products/'.$case->image)}}" height="40" width="40" alt="">
                                                @endif
                                            </td>
                                            <td>{{$case->case}}</td>
                                            <td>{{$case->price}}</td>
                                            <td>{{$case->preform_g}}</td>
                                            <td>{{$case->cap_g}}</td>
                                            <td>{{$case->label_g}}</td>
{{--                                            <td>{{$case->cap_no}}</td>--}}
{{--                                            <td>{{$case->label_no}}</td>--}}
                                            <td>{{$case->description}}</td>
{{--                                            <td align="center"><a role="button"  class="editCasebtn fa fa-edit text-success" id="{{$case->id}}"></a></td>--}}
                                            <td align="center"><a href="{{route('admin.editProduct', ['id'=>$case->id])}}" role="button" class="fa fa-edit text-success"></a> |
                                            <a href="{{route('case.delete',['id'=>$case->id])}}" class="fa fa-trash text-danger"></a></td>

                                        </tr>
                                        @include('admin.includes.edit_case_modal')
                                    @endforeach
                                @else
{{--                                    <td>--}}
{{--                                        No users added yet!--}}
{{--                                    </td>--}}


                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

        @include('admin.includes.add_case_modal')


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
