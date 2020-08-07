<?php
$settings = \App\Setting::where('id',1)->first();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('frontend/vendors/bootstrap/bootstrap.min.css')}}">
</head>

<body >
<header class="clearfix" style="padding-bottom: -0.2rem; ">
    <div id="logo" style="text-align: center; padding-bottom: -1rem">
        <img src="images/logo/Cfresh-label.png" height="100px" width="100px">
    </div>
    <div class="row" style="margin-top: 2rem; padding-top: 1rem">
        <div class="float-left col-sm-4 ">
            <table class="table table-bordered w-100 table-sm" style="font-size: 12px">
                <tr>
                    <td>Statement Period</td>
                    <td>{{$from}} to {{$to}}</td>
                </tr>
                <tr>
                    <td>Total Cost</td>
                    <td>NGN {{number_format($total_cost, 2)}}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4 float-right" >
            <table class="table table-borderless table-sm w-100" >
                <tr>
                    <td><span style="color: darkred; font-size: 16px; padding-bottom: -0.6rem; text-align: right"><strong><h3>{{$settings->site_name}}</h3></strong></span></td>
                </tr>
                <tr>
                    <td style="font-size: 14px; color: #cccccc; padding-top:-1rem; text-align: right ">{{$settings->contact_address}}</td>
                </tr>
            </table>


        </div>
    </div>
</header>
<div class="table-responsive" style="padding-top: -0.2rem">
    <table class="table table-striped table-bordered" style='background: url("{{asset('images/logo/dimension.png')}}");'>
        <thead>
        <tr style="background-color: darkred; color: white; font-size: 12px">
            <th >Batch Date</th>
            <th>Batch Name</th>
            <th>Cost</th>
            <th>Material</th>
            <th>Bags</th>
            <th>Total Materials</th>
            <th>material/bag</th>
            <th>Company</th>
            <th>Description</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($PDFReport as $PDFReports)
            <tr style="font-size: 10px">
                <td style="background-color: lightgoldenrodyellow">{{\Carbon\Carbon::parse($PDFReports->created_at)->toFormattedDateString()}}</td>
                <td>{{ $PDFReports->batch_name }}</td>
                <td>NGN {{number_format($PDFReports->amount, 2)}}</td>
                <td>{{$PDFReports->material}}</td>
                <td>{{$PDFReports->no_bags}}</td>
                <td>{{$PDFReports->tot_materials}}</td>
                <td>{{$PDFReports->no_materials}}</td>
                <td>{{$PDFReports->company}}</td>
                <td>{{$PDFReports->description}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="{{asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/popper.min.js') }}"></script>
<script src="{{asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
