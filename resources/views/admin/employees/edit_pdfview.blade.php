<?php
$settings = \App\Setting::where('id',1)->first();

$first = \App\Box::all()->first()->id;
$last = \App\Box::all()->last()->id;
$cases = \App\Box::all();
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
        <h3 class="text-bold text-primary">{{$employee->name}} - Summary of Sales  </h3>
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
                    <td style="background-color: darkred; color: white;"><strong>Quantities</strong></td>
                    <td>{{number_format($total_quantity, 0)}}</td>
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
            <th>Sales Rep.</th>
            <th>Quantities </th>
            <th>Target </th>
            <th>Customer </th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        <?php $sum1 = 0; $sum2 =0 ?>
        @foreach($PDFReport as $order)
            <tr>
                <td>{{\Carbon\Carbon::parse($order->created_at)->toDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($order->created_at)->format('H:i A')}}</td>
                <td>{{$order->employee->name}}</td>
                <td>{{$sum1 = $order->orders->sum('product_qty')}}</td>
                <?php $sum2 =$sum1+$sum2 ?>
                <td>
                    @if($target != 0)
                        {{round($sum2*100/$target)}}%
                    @endif
                </td>
                <td>{{$order->user->name}}</td>
                <td class="text-center">
                    @if($target != 0)
                        @if($sum2<=(int)(0.5*($target)))
                            <span style="color: Red"><strong>{{'Under Performed'}}</strong></span>
                        @elseif($sum2>=(int)(0.5*($target)) && $sum2<=(int)(0.75*($target)))
                            <span style="color: darkred"><strong>{{'Fair'}}</strong></span>

                        @elseif($sum2>=(int)(0.75*($target)) && $sum2<(int)(1*($target)))
                            <span style="color: blue"><strong>{{'Almost There ...'}}</strong></span>

                        @elseif($sum2==(int)(1*($target)))
                            <span style="color: blue"><strong>{{'Target Met'}}</strong></span>

                        @elseif($sum2>=(int)(1*($target)) && $sum2<=(int)(1.25*($target)))
                            <span style="color: darkblue"><strong>{{'Good'}}</strong></span>
                        @elseif($sum2>=(int)(1.25*($target)))
                            <span style="color: midnightblue"><strong>{{'Excellent'}}</strong></span>
                        @endif
                    @endif
                </td>


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
