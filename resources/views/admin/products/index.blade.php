@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-store"></i> C-Fresh Store </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
{{--                    <li><a href="#">Inventory </i> </a> - </li>--}}
                    <li class="active"> Store</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                  <span class="float-left text-sm" style="font-style: italic" >
                     @foreach($cases as $case)
                          <span style="color: blue"><strong>Case {{$case->case}}:</strong></span>
                          {{(\App\Store::where('box_id',$case->id)->where('flow','In flow')->sum('quantity'))-
                          (\App\Store::where('box_id',$case->id)->where('flow','Out flow')->sum('quantity'))}}
                          &nbsp;
                      @endforeach
                </span>
            </div>
{{--            <div class="col-md-2 " style="margin-top: -1rem; margin-bottom: 0.5rem">--}}
{{--                <a role="button" href="{{route('order.create')}}"  class="float-right">--}}
{{--                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Order</span>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <strong><i class="fa fa-money-bill"></i> Store</strong> - Summary
                        <div class="float-right" >
                            <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{--                                <div class="container">--}}
                                <div class="row" style="font-size: 12px">
                                    <label for="from" class="col-form-label">From</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control form-control-sm " id="from" name="from">
                                    </div>
                                    <label for="from" class="col-form-label">To</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control form-control-sm" id="to" name="to">
                                    </div>

                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary btn-xs" name="search" >Search</button>
                                    </div>&nbsp;
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-success btn-xs" name="exportPDF" >ExportPDF</button>
                                    </div>
                                </div>
                                {{--                                </div>--}}
                            </form>
                        </div>
                    </div><!-- /.card-header -->
                            <div class="card card-info">

                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 0.8rem">
                                        <table id="store_list" class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Quantities </th>
                                                <th>Case Type</th>
                                                <th>Employee</th>
                                                <th>Balance</th>
                                                <th>Status</th>
{{--                                                <th></th>--}}

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{\Carbon\Carbon::parse($product->created_at)->toDateString()}}</td>
                                                    <td>{{\Carbon\Carbon::parse($product->created_at)->format('H:i:s A')}}</td>
                                                    <td>{{$product->quantity}}</td>
                                                    <td>{{$product->box['case']}}</td>
                                                    <td>{{!empty($product->employee) ? $product->employee->name : ''}}</td>
                                                    <td>{{$product->balance}}</td>

                                                    @if($product->flow == 'In flow')
                                                        <td style="background: darkblue; color: white"><strong>{{$product->flow}}</strong></td>
                                                    @else
                                                        <td style="background: darkslategrey; color: white"><strong>{{$product->flow}}</strong></td>
                                                    @endif


{{--                                                    <td></td>--}}
{{--                                                    <td></td>--}}
{{--                                                    <td>{{\Carbon\Carbon::parse($preform->created_at)->format('jS  F Y')}}</td>--}}
{{--                                                    <td><a class="moveMaterialbtn btn btn-xs btn-outline-info" id="{{$preform->id}}" data-mat="1">Move to Process</a></td>--}}
{{--                                                    <td align="center"><a role="button" href="{{route('stock.edit',['id'=>$preform->id])}}"  class="fa fa-edit text-success"></a></td>--}}
{{--                                                    <td align="center"><a href="{{route('stock.delete',['id'=>$preform->id])}}" class="fa fa-trash text-danger"></a></td>--}}

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

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>
        $(function () {
            $("#store_list").DataTable({
                "responsive": true,
                "autoWidth": false,
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

            $("#caps_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $("#labels_list").DataTable({
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

        $('#bags').focus(function () {
            var $stock_bag = parseInt($('#total_bags').val());
            var $bags = parseInt($(this).val());
            if($bags > $stock_bag) {
                console.log('Input ' + $bags);
                console.log('amount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",true);
                $('.notification').removeAttr('hidden');
                $('#notification').text(' This number is more than available bags in stock');
                $('.notification').delay(6000).slideUp(300).html(ul);

            }else
            {
                console.log('FInput ' + $bags);
                console.log('Famount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",false);
            }

        });

        $('#bags').blur(function () {
            var $stock_bag = parseInt($('#total_bags').val());
            var $bags = parseInt($(this).val());
            if($bags > $stock_bag) {
                console.log('Input ' + $bags);
                console.log('amount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",true);
                $('.notification').removeAttr('hidden');
                $('#notification').text(' This number is more than available bags in stock');
                $('.notification').delay(6000).slideUp(300).html(ul);

            }else
            {
                console.log('FInput ' + $bags);
                console.log('Famount in Stock '+ $stock_bag);
                $('#btnMove').attr("disabled",false);
            }

        });

    </script>
@endsection
