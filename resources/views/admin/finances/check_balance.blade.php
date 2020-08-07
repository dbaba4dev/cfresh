@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap4_toggle.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-balance-scale"></i> Check and Balances </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Finance </i> </a> - </li>
                    <li class="active"> Check and Balances</li>
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
                        <i class="fa fa-balance-scale"></i> Check and Balances
                        <div class="float-right" >
                            <form action="{{route('income.search')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{--                                <div class="container">--}}
                                {{--                                <div class="row" style="font-size: 12px">--}}
                                {{--                                    <label for="from" class="col-form-label">From</label>--}}
                                {{--                                    <div class="col-md-4">--}}
                                {{--                                        <input type="date" class="form-control form-control-sm " id="from" name="from">--}}
                                {{--                                    </div>--}}
                                {{--                                    <label for="from" class="col-form-label">To</label>--}}
                                {{--                                    <div class="col-md-4">--}}
                                {{--                                        <input type="date" class="form-control form-control-sm" id="to" name="to">--}}
                                {{--                                    </div>--}}

                                {{--                                    <div class="col-md-1">--}}
                                {{--                                        <button type="submit" class="btn btn-primary btn-xs" name="search" >Search</button>--}}
                                {{--                                    </div>&nbsp;--}}
                                {{--                                    <div class="col-md-1">--}}
                                {{--                                        <button type="submit" class="btn btn-success btn-xs" name="exportPDF" >ExportPDF</button>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                </div>--}}
                            </form>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card card-info">

                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 0.8rem">
                                <table id="batch_history" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Cash Income</th>
                                        <th>Cash Expenses</th>
                                        <th>Daily Balance</th>
                                        <th>Net Balance</th>
                                        <th>Same with the cash at hand?</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cashBalances as $cash_balance)
                                        <tr  @if ($cash_balance->question == 'No') class="text-danger" @endif>
                                            <td>{{\Carbon\Carbon::parse($cash_balance->created_at)->toFormattedDateString()}}</td>
                                            <td>{{\Carbon\Carbon::parse($cash_balance->created_at)->format('h:i A')}}</td>
                                            <td>&#8358 {{number_format($cash_balance->daily_income, 2)}}</td>
                                            <td>&#8358 {{number_format($cash_balance->daily_expense, 2)}}</td>
                                            <td>&#8358 {{number_format($cash_balance->balance, 2)}}</td>
                                            <td>&#8358 {{number_format(abs($cash_balance->new_balance), 2)}}</td>
                                            <form action="{{route('check.balance')}}" method="post" id="check_balance">
                                                @csrf
                                                @if($cash_balance->status == 0)
                                                    <td>
{{--                                                        <div class="form-group row">--}}

                                                        <input type="checkbox" id="question_{{$cash_balance->id}}" name="question" rel="{{$cash_balance->id}}" data-toggle="toggle" @if(!empty($cash_balance->question)) {{ $cash_balance->question == 'Yes' ? 'checked' : ''}}  @endif  class="btn_question" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="sm">
{{--                                                            <div class="custom-control custom-radio col-sm-1 mt-2 ml-3 expense_option">--}}
{{--                                                                <input class="custom-control-input" type="radio" id="yes" value="Yes" name="question_{{$cash_balance->id}}">--}}
{{--                                                                <input  type="radio" id="yes" value="Yes" class="form-control" name="question_{{$cash_balance->id}}">--}}
{{--                                                                <label for="yes" >Yes</label>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="custom-control custom-radio col-sm-1 mt-2 ml-5 expense_option">--}}
{{--                                                                <input  type="radio" id="no" value="No" class="form-control" name="question_{{$cash_balance->id}}" >--}}
{{--                                                                <label for="no" >No</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <input type="hidden" name="questions" id="questions_{{$cash_balance->id}}">
                                                        <input type="hidden" name="id" value="{{$cash_balance->id}}" >
                                                    </td>
                                                    <td>
                                                        <textarea name="description" hidden id="description" class="form-control form-control-sm yes_{{$cash_balance->id}}"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="submit"  value="Submit" class="btn btn-outline-primary ">
                                                    </td>
                                                @endif
                                                @if($cash_balance->status == 1)
                                                    <td>
                                                        {{$cash_balance->question}}
                                                    </td>
                                                    <td>
                                                        {{$cash_balance->description}}
                                                    </td>
                                                    <td>
                                                        <input type="submit" hidden  value="Submitted" class="btn btn-outline-success yes_{{$cash_balance->id}}" disabled>
                                                    </td>
                                                @endif
                                            </form>




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
    <script src="{{asset('js/bootstrap4-toggle.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>
        $(function () {
            $("#batch_history").DataTable({
                "responsive": true,
                "autoWidth": false,
                "footer": true,
                "aaSorting": [ [0,'desc'], [1,'desc'] ],
                dom: 'Bfrtip',
                lengthMenu: [[10,25,50,100, -1], [10, 25, 50,100, "All"]],
                buttons: [
                    'excel',
                    {
                        extend: "pdfHtml5",

                        customize: function(doc) {
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'center',
                                            text: [
                                                { text: page.toString(), italics: true },
                                                ' of ',
                                                { text: pages.toString(), italics: true }
                                            ]
                                        }],
                                    margin: [10, 0]
                                }
                            });
                        }
                    },
                    'print',
                    'pageLength'
                ]
            });
        });


        $('.btn_question').on('change', function () {
            var id = $(this).attr('rel');

            var action = $('#question_'+id).prop('checked');
                if(action)
                {
                    $("input[name='question']").val('Yes');
                    $('#questions_'+id).val('Yes');
                    $('.yes_'+id).attr('hidden', true);
                }else
                {
                    $('#questions_'+id).val('No');
                    $("input[name='question']").val('No');
                    $('.yes_'+id).attr('hidden', false);
                }



        });





    </script>

    <script src="{{asset('js/scripts.js')}}"></script>
@endsection
