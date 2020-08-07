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
        <img src="{{asset('images/logo/Cfresh-label.png')}}" height="100px" width="100px"><br><br>
        <h3 class="text-bold text-primary">{{$employee->name}} - Account Summary  </h3>
        <br><br>
    </div>
    <div class="row" style="margin-top: 2rem; padding-top: 1rem">
        <div class="float-left col-sm-4 ">
            <table class="table table-bordered w-100 table-sm" style="font-size: 12px">
                <tr >
                    <td style="background-color: darkred; color: white;"><strong>Statement Period</strong></td>
                    <td>{{\Carbon\Carbon::parse($from)->toFormattedDateString()}} to {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</td>
                </tr>

{{--                <tr>--}}
{{--                    <td class="text-center" style="background-color: darkred; color: white;" colspan="2"><strong>Remaining Products</strong></td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td style="background-color: darkred; color: white;"><strong>In flow</strong></td>--}}
{{--                    <td>{{number_format($in_flow, 2)}}</td>--}}
{{--                </tr>--}}
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Total Amount</strong></td>
                    <td>{{number_format($total_amount, 0)}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Curernt Balance</strong></td>
                    <td>{{number_format($balance, 0)}}</td>
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
                    <td style="font-size: 14px; color: #cccccc; text-align: right ">{{$settings->contact_address}}</td>
                </tr>
                <tr>
                    <td style="font-size: 14px; color: #cccccc;  text-align: right ">{{$settings->contact_email}}-({{$settings->contact_number}})</td>
                </tr>
            </table>


        </div>
    </div>
</header>
<div class="table-responsive" style="padding-top: -0.2rem">
    <table class="table table-striped table-bordered" style='background: url("{{asset('images/logo/dimension.png')}}"); font-size: 10px' >
        <thead>
        <tr style="background-color: darkred; color: white; font-size: 12px">
            <th>Date</th>
            <th>Time</th>
            <th>Amount</th>
            <th>Balance </th>
            <th>Payment Type </th>
            <th>User </th>
            <th>Description </th>

        </tr>
        </thead>
        <tbody>
            @foreach($PDFReport as $account)
                <tr>
                    <td>{{\Carbon\Carbon::parse($account->created_at)->toDateString()}}</td>
                    <td>{{\Carbon\Carbon::parse($account->created_at)->format('H:i A')}}</td>
                    <td>{{$account->amount}}</td>
                    <td>{{$account->balance}}</td>
                    <td>{{$account->cash_type}}</td>
                    <td>{{\App\Admin::where('id', $account->admin->id)->first()->employee->name}}</td>
                    <td>{{$account->description}}</td>

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
