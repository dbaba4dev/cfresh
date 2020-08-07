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
                <h1><i class="fa fa-users"></i> Employees </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"> Home </a> - </li>
                    <li><a href="#">Employees </i> </a> - </li>
                    <li class="active"> Payments </li>
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
                                <h3 class="card-title"><i class="fa fa-money-check-alt"> </i>  Payments  <b>Types</b> </h3>
                            </div>
                            <div class="col-sm-6 ">
                                <a  role="button" data-toggle="modal" data-target="#addPayTypeModal" class="float-right">
                                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Type</span>
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
                                    <th>ID</th>
                                    <th>Payment Type</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($pay_types as $pay_type)
                                        <tr>
                                            <td>{{$pay_type->id}}</td>
                                            <td>{{$pay_type->type}}</td>
                                            <td>{{\Carbon\Carbon::parse($pay_type->created_at)->format('jS  F Y h:i:s A')}}</td>
                                            {{--                                            <td>{{\Carbon\Carbon::parse($category->updated_at)->format('jS  F Y h:i:s A')}}</td>--}}
                                            <td align="center"><a role="button"  class="editbtn fa fa-edit text-success" id="{{$pay_type->id}}"></a></td>
                                            <td align="center"><a href="{{route('payment.delete',['id'=>$pay_type->id])}}" class="fa fa-trash text-danger"></a></td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>



    </section>
@endsection
@include('admin.includes.add_pay_type_modal')
@include('admin.includes.edit_pay_type_modal')

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

{{--    <script>--}}
{{--        $("select[name='payment_id']").change(function(){--}}
{{--            // console.log('I have Changed');--}}
{{--            var $type = $(this).val();--}}
{{--            console.log($type);--}}
{{--            if($type == 2)--}}
{{--            {--}}
{{--                $('#amount_box').removeAttr('hidden');--}}
{{--                $('#amount_box').attr('required','required');--}}
{{--            }else--}}
{{--            {--}}
{{--                $('#amount').removeAttr('required');--}}
{{--                $('#amount_box').attr('hidden',true);--}}
{{--            }--}}

{{--            // $('#selected_material_val').val($material);--}}

{{--        });--}}
{{--    </script>--}}

@endsection
