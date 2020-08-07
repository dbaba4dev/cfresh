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
                <h1><i class="fa fa-book-open"></i> Move Finished Products to Store  </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Products </i> </a> - </li>
                    <li class="active">Finished Products</li>
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
                        <h5 class="card-title">Finished - <strong>Products</strong></h5>
                    </div>
                    {{--                   <form action="{{route('admin.addAttribute', ['id'=>$product->id])}}" id="add_attribute" name="add_attribute" method="post" enctype="multipart/form-data">--}}
                    <form action="{{route('products.finished')}}" method="post" id="finished_prd">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row my-0" >
                                <label for="material" class="col-sm-2 col-form-label text-right">Product type</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <select name="product_type" id="product_type" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach($cases as $case)
                                            <option value="{{$case->id}}">{{$case->case}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                {{--                               <div class="col-md-6">--}}
                                <label for="material" class="col-sm-2 col-form-label text-right">Quantity</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <input type="number" name="quantity" id="quantity" min="0" class="form-control form-control-sm " required>

                                </div>

                            </div>
                            <hr class="my-0">

                            <div class="form-group row my-0" >
                                <label for="material" class="col-sm-2 col-form-label text-right">Store Keeper</label>
                                <div class="col-sm-2" style="margin-top: 0.3rem">
                                    <select name="store_keeper" id="store_keeper" class="form-control form-control-sm select2" required>
                                        <option value="" selected disabled>Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <hr class="my-1">
                            <div class="form-group row my-0" >
                                <label for="comment" class="col-sm-2 col-form-label text-right">Comment</label>
                                <div class="col-sm-9" style="margin-left: -0.3rem">
                                    <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr class="my-1" >

                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" value="Save to Store" class="btn btn-success">
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
