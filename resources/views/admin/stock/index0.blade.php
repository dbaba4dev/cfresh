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
                <h1><i class="fa fa-book-open"></i> Inventory </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
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
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2 " style="margin-top: -1rem; margin-bottom: 0.5rem">
                <a role="button" href="{{route('stock.create')}}"  class="float-right">
                    <span class="btn btn-info"><i class="fa fa-plus-circle"></i> New Batch</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2 bg-gradient-gray-dark">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#preform" data-toggle="tab" style="color: #fff">Preforms</a></li>
                            <li class="nav-item"><a class="nav-link" href="#cap" data-toggle="tab" style="color: #fff">Caps</a></li>
                            <li class="nav-item"><a class="nav-link" href="#label" data-toggle="tab" style="color: #fff">Labels</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="tab-content">
                        <div class="active tab-pane" id="preform">
                            <div class="card card-info">

                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 0.8rem">
                                        <table id="preforms_list" class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>No. Bags</th>
                                                <th>No. of Preform/Bag </th>
                                                <th>Total Preforms</th>
                                                <th>weight/Bag (kg)</th>
                                                <th>Preform (g) </th>
                                                <th>Comment</th>
                                                <th>Added on</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($preforms as $preform)
                                                @if($preform->preform->no_bags !=0)
                                                    <tr>
                                                    <td>{{$preform->preform->company}}</td>
                                                    <td>{{$preform->preform->no_bags}}</td>
                                                    <td>{{$preform->preform->no_preform}}</td>
                                                    <td>{{$preform->preform->tot_preform}}</td>
                                                    <td>{{$preform->preform->kg_per_bag}}</td>
                                                    <td>{{$preform->preform->box->preform_g}}</td>
                                                    <td>{{$preform->comment}}</td>
                                                    <td>{{\Carbon\Carbon::parse($preform->created_at)->format('jS  F Y')}}</td>
                                                    <td><a class="moveMaterialbtn btn btn-xs btn-outline-info" id="{{$preform->id}}" data-mat="1">Move to Process</a></td>
                                                    <td align="center"><a role="button" href="{{route('stock.edit',['id'=>$preform->id])}}"  class="fa fa-edit text-success"></a></td>
                                                    <td align="center"><a href="{{route('stock.delete',['id'=>$preform->id])}}" class="fa fa-trash text-danger"></a></td>

                                                </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="tab-pane" id="cap">
                            <div class="card card-info">

                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 0.8rem">
                                        <table id="caps_list" class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>No. Bags</th>
                                                <th>No. of Cap/Bag </th>
                                                <th>Total Caps</th>
                                                <th>weight/Bag (kg)</th>
                                                <th>Cap (g) </th>
                                                <th>Comment</th>
                                                <th>Added on</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($caps as $cap)
                                                @if($cap->cap->no_bags !=0)
                                                <tr>
                                                    <td>{{$cap->cap->company}}</td>
                                                    <td>{{$cap->cap->no_bags}}</td>
                                                    <td>{{$cap->cap->no_cap}}</td>
                                                    <td>{{$cap->cap->tot_cap}}</td>
                                                    <td>{{$cap->cap->kg_per_bag}}</td>
                                                    <td>{{$cap->cap->cap_g}}</td>
                                                    <td>{{$cap->comment}}</td>
                                                    <td>{{\Carbon\Carbon::parse($cap->created_at)->format('jS  F Y')}}</td>
                                                    <td><a class="moveMaterialbtn btn btn-xs btn-outline-info" id="{{$cap->id}}" data-mat="2">Move to Process</a></td>
                                                    <td align="center"><a role="button" href="{{route('stock.edit',['id'=>$cap->id])}}"  class="fa fa-edit text-success"></a></td>
                                                    <td align="center"><a href="{{route('stock.delete',['id'=>$cap->id])}}" class="fa fa-trash text-danger"></a></td>

                                                </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="label">
                            <div class="card card-info">

                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 0.8rem">
                                        <table id="labels_list" class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>

                                                <th>Company</th>
                                                <th>No. Bags</th>
                                                <th>No. of Label/Bag </th>
                                                <th>Total Labels</th>
                                                <th>weight/Bag (kg)</th>
                                                <th>Label (g) </th>

                                                <th>Comment</th>
                                                <th>Added on</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($labels as $label)
                                                @if(!empty($label->label->no_bags))
                                                <tr>
                                                    <td>{{$label->label->company}}</td>
                                                    <td>{{!empty($label->label->no_bags) ? $label->label->no_bags : ''}}</td>
                                                    <td>{{!empty($label->label->no_label) ? $label->label->no_label : ''}}</td>
                                                    <td>{{!empty($label->label->tot_label) ? $label->label->tot_label : ''}}</td>
                                                    <td>{{!empty($label->label->kg_per_bag) ? $label->label->kg_per_bag : ''}}</td>
                                                    <td>{{!empty($label->label->label_g) ? $label->label->label_g :
                                                    number_format(($label->label->kg_bags)*1000/($label->label->no_label),1)}}</td>
                                                    <td>{{$label->comment}}</td>
                                                    <td>{{\Carbon\Carbon::parse($label->created_at)->format('jS  F Y')}}</td>
                                                    <td><a class="moveMaterialbtn btn btn-xs btn-outline-info" id="{{$label->id}}" data-mat="3">Move to Process</a></td>
                                                    <td align="center"><a role="button" href="{{route('stock.edit',['id'=>$label->id])}}"  class="fa fa-edit text-success"></a></td>
                                                    <td align="center"><a href="{{route('stock.delete',['id'=>$label->id])}}" class="fa fa-trash text-danger"></a></td>

                                                </tr>
                                                @endif
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
                <!-- /.nav-tabs-custom -->
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

    <script>
        $(function () {
            $("#preforms_list").DataTable({
                "responsive": true,
                "autoWidth": false,
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
