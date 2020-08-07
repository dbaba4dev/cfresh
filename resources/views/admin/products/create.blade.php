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
                <h1>Finished Products </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Inventory </i> </a> - </li>
                    <li class="active"> Products</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        @include('admin.includes.errors')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-box-open"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Expected Cases</span>
                                    <span class="info-box-number">
                                        @foreach($summaries as $summary)
                                            {{$summary->box->case}}: {{ floor($summary->no_preform/12)}} <br>
                                        @endforeach
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-capsules"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Preforms in Process</span>
                                    <span class="info-box-number" style="font-size: 1rem">
                                        @foreach($summaries as $summary)
                                            {{$summary->box->case}}: {{ $summary->no_preform}} <br>
                                        @endforeach
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa fa-hat-wizard"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Caps in Process</span>
                                    <span class="info-box-number">{{$summaries->first()->no_cap}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-landmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Label in Process</span>
                                    <span class="info-box-number">{{$summaries->first()->no_label}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <form action="{{route('product.store')}}" method="post">
                        {{csrf_field()}}

                        <div class="card card-info">

                            <div class="card-header">
                                <h3 class="card-title">New Product Record</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="text-xs">Product Type</label>
                                            <select class="form-control-sm select2" name="case_id" id="case_id" required style="width: 100%;">
                                                <option value="" selected disabled>Select Product Type</option>
                                                @foreach($cases as $case)
                                                    <option value="{{$case->id}}">{{$case->case}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="text-xs">
                                                Number of Cases
                                            </label>
                                            <input class="form-control form-control-sm" id="no_cases" name="no_cases" required  type="number">

                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="text-xs">Moved by</label>
                                            <select class="form-control-sm select2" name="employee_id" id="employee_id" required style="width: 100%;">
                                                <option value="" selected disabled>Select a Store Keeper</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="text-xs">
                                                Information
                                            </label>
                                            <input class="form-control form-control-sm" id="comments" name="comments"   type="text">
                                            </input>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <button class="btn btn-info btn-sm" id="btn-add" type="submit" value="add">
                                   <i class="fa fa-save"></i> Save Record
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>


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
        $("select[name='raw_material']").change(function(){
            console.log('I have Changed');
            var $mat = $(this).val();
            console.log($mat);
            if($mat == 1)
            {
                $('#material').text(' Preform Weight (g)');
            }else if($mat == 2)
            {
                $('#material').text(' Cap Weight (g)');
            }else if($mat == 3)
            {
                $('#material').text(' Label Weight (g)');
            }

            // $('#selected_material_val').val($material);

        });
    </script>
@endsection
