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
                <h1>Stocks </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Inventory </i> </a> - </li>
                    <li class="active"> Stock</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        @include('admin.includes.errors')
        <form action="{{route('stock.store')}}" method="post">
            {{csrf_field()}}

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">New Batch</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">Material</label>
                                <select class="form-control-sm select2" name="raw_material" id="raw_material" style="width: 100%;">
                                    {{--                                    <option value="" selected disabled>Select Material</option>--}}
                                    @foreach($materials as $material)
                                        <option value="{{$material->id}}">{{$material->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="selected_material_val" name="selected_material_val">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-xs">
                                    Case Type
                                </label>
                                <select class="form-control-sm select2" name="preform_weight" id="preform_weight" style="width: 100%;">
                                    <option value="" selected disabled>Select Case type</option>
                                    @foreach($cases as $case)
                                        <option value="{{$case->id}}">{{$case->case}}</option>
                                    @endforeach
                                </select>
{{--                                <input class="form-control form-control-sm" id="preform_weight" name="preform_weight" required  type="text">--}}

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="text-xs">
                                    Company name
                                </label>
                                <input class="form-control form-control-sm" id="name" name="company"   type="text">
                                </input>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="text-xs" id="mat_val">
                                    Weight/Bag (kg)
                                </label>
                                <input class="form-control form-control-sm" id="kg_bags" name="kg_bags" required  type="text">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="text-xs">
                                    Number of Bags
                                </label>
                                <input class="form-control form-control-sm" id="no_bags" name="no_bags" required  type="number">
                                </input>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="text-xs">
                                    Comments
                                </label>
                                <input class="form-control form-control-sm" id="comment" name="comment"   type="text">
                                </input>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <button class="btn btn-info btn-sm" id="btn-add" type="submit" value="add">
                        Add Batch
                    </button>
                </div>
            </div>
        </form>

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
    <script>
        // $("select[name='raw_material']").change(function(){
        //     console.log('I have Changed');
        //     var $mat = $(this).val();
        //     console.log($mat);
        //     if($mat == 1)
        //     {
        //         $('#mat_val').text(' Weight of Bags (kg)');
        //     }else if($mat == 2)
        //     {
        //         $('#mat_val').text(' No. of Caps');
        //     }else if($mat == 3)
        //     {
        //         $('#mat_val').text(' No. of Labels');
        //     }
        //
        //     // $('#selected_material_val').val($material);
        //
        // });
    </script>
@endsection
