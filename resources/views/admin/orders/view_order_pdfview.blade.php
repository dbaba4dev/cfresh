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
                    <td><strong>Statement Period</strong></td>
                    <td>{{$from}} to {{$to}}</td>
                </tr>
                <tr>
                    <td><strong>Total Income</strong></td>
                    <td>NGN {{number_format($total_income, 2)}}</td>
                </tr>
                <tr>
                    <td><strong>Total Credit</strong></td>
                    <td>NGN {{number_format($total_balance, 2)}}</td>
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
    <table class="table table-striped table-bordered" style='background: url("{{asset('images/logo/dimension.png')}}"); font-size: 10px' >
        <thead>
        <tr style="background-color: darkred; color: white; font-size: 12px">
            <th>ID</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Ordered Product</th>
            <th>Order Amount</th>
            <th>Amount Paid</th>
            <th>Balance</th>
            <th>Discount</th>
            <th>Payment Method</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($PDFReport as $PDFReports)
            <tr>
                <td>{{$PDFReports->id}}</td>
                <td>{{\Carbon\Carbon::parse($PDFReports->created_at)->toFormattedDateString()}}</td>
                <td>{{$PDFReports->name}}</td>
                <td>{{$PDFReports->user_email}}</td>
                <td>
                    @foreach($PDFReports->orders as $pro)
                        {{$pro->product_name}} - ({{$pro->product_qty}})
                        <br>
                    @endforeach
                </td>
                <td>NGN {{number_format($PDFReports->grand_total, 2)}}</td>
                <td>{{$PDFReports->amount_paid}}</td>
                <td>{{$PDFReports->balance}}</td>
                <td>NGN {{number_format($PDFReports->coupon_amount, 2)}}</td>
                <td>{{$PDFReports->payment_method}}</td>
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
