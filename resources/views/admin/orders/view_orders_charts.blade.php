{{--@include('admin.includes.charts')--}}
<?php

$dataPoints1 = $dataset[0];
$dataPoints2 = $dataset[1];
//echo $sales_arr[0]; exit();

?>

@extends('admin.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

@endsection

@section('page-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-shopping-bag"></i> Orders Chart </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-tachometer-alt"></i> Home </a> - </li>
                    <li><a href="#">Orders Chart </i> </a> - </li>
                    <li class="active"> View Orders Chart</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <hr style="border: solid 0.5px #a3a3a3">
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="card container">
                <div class="card-body row d-flex justify-content-between">
                    <p>Monthly Sales | 2020</p>
                    <div class="">
                        <select name="year" id="year" class="form-control form-control-sm">
                            <option value="" disabled>Select Year</option>
{{--                            @foreach($year_list as $row)--}}
{{--                                <option value="{{$row->year}}">{{$row->year}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
                </div>
                <hr style="margin: 0">
                <div class="card-body" style="height: 370px; width: 100%;">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>


        <script src="{{asset('js/canvas.js')}}"></script>

    </section>
@endsection

@section('scripts')
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Monthly Sales Report"
                },
                theme: "light1",
                animationEnabled: true,
                exportEnabled: true,
                toolTip:{
                    shared: true,
                    reversed: true
                },
                axisY: {
                    title: "Sales",
                    suffix: " NGN"
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: [
                    {
                        type: "stackedColumn",
                        name: "<?php echo $prod_name[0]; ?>" ,
                        showInLegend: true,
                        yValueFormatString: "#,##0 NGN",
                        // color: '#4169e1',
                        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "stackedColumn",
                        name: "<?php echo $prod_name[1]; ?>" ,
                        showInLegend: true,
                        yValueFormatString: "#,##0 NGN",
                        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                    },
                    // {
                    {{--    type: "stackedColumn",--}}
                    {{--    name: "Americas",--}}
                    {{--    showInLegend: true,--}}
                    {{--    yValueFormatString: "#,##0 MW",--}}
                    {{--    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>--}}
                    {{--},{--}}
                    {{--    type: "stackedColumn",--}}
                    {{--    name: "China",--}}
                    {{--    showInLegend: true,--}}
                    {{--    yValueFormatString: "#,##0 MW",--}}
                    {{--    dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>--}}
                    {{--},{--}}
                    {{--    type: "stackedColumn",--}}
                    {{--    name: "Middle East and Africa",--}}
                    {{--    showInLegend: true,--}}
                    {{--    yValueFormatString: "#,##0 MW",--}}
                    {{--    dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>--}}
                    {{--},{--}}
                    {{--    type: "stackedColumn",--}}
                    {{--    name: "Rest of the world",--}}
                    {{--    showInLegend: true,--}}
                    {{--    yValueFormatString: "#,##0 MW",--}}
                    {{--    dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>--}}
                    {{--}--}}
                ]
            });

            chart.render();

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

        }
    </script>
@endsection
