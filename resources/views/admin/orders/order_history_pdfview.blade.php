<?php
$settings = \App\Setting::where('id',1)->first();

$first = \App\Box::all()->first()->id;
$last = \App\Box::all()->last()->id;
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
        <img src="{{asset('images/logo/Cfresh-label.png')}}" height="100px" width="100px">
    </div>
    <div class="row" style="margin-top: 2rem; padding-top: 1rem">
        <div class="float-left col-sm-4 ">
            <table class="table table-bordered w-100 table-sm" style="font-size: 12px">
                <tr >
                    <td style="background-color: darkred; color: white;"><strong>Statement Period</strong></td>
                    <td>{{$from}} to {{$to}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Total Order Amount</strong></td>
                    <td>NGN {{number_format($total_amount, 2)}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Total Amount Paid</strong></td>
                    <td>NGN {{number_format($total_paid, 2)}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Total Discount</strong></td>
                    <td>NGN {{number_format($total_discount, 2)}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Total Balance</strong></td>
                    <td class="text-danger">NGN {{number_format($total_balance, 2)}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Customer Name</strong></td>
                    <td class="text-bold text-primary">{{$user->name}}</td>
                </tr>
                <tr>
                    <td style="background-color: darkred; color: white;"><strong>Customer Address</strong></td>
                    <td class="text-bold text-primary">{{$user->address}}</td>
                </tr>
                @for($i = $first; $i<=$last; $i++)
                    <tr>
                        <td style="background-color: darkred; color: white;"><strong>{{\App\Box::where('id',$i)->first()->case}}</strong></td>
                        <td>{{$prod_sum['prod'.$i]}}</td>
                    </tr>
                @endfor
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
            <th>Order Date</th>
            <th>Time</th>
            <th>Ordered Product</th>
            <th>Order Amount</th>
            <th>Amount Paid</th>
            <th>Balance</th>
            <th>Discount</th>
            <th>Payment Method</th>
            <th>Sales Reps.</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($PDFReport as $PDFReports)
            <tr>
                <td>{{\Carbon\Carbon::parse($PDFReports->created_at)->toDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($PDFReports->created_at)->format('H:i:s A')}}</td>
                <td>
                    @foreach($PDFReports->orders as $pro)
                        {{$pro->product_name}} - ({{$pro->product_qty}})
                        <br>
                    @endforeach
                </td>
                <td>NGN {{number_format($PDFReports->grand_total,2 )}}</td>
                <td>NGN {{number_format($PDFReports->amount_paid, 2)}}</td>
                <td>NGN {{number_format($PDFReports->balance,2 )}}</td>
                <td>NGN {{number_format($PDFReports->coupon_amount, 2)}}</td>

{{--                <td>{{$PDFReports->coupon_code}}</td>--}}
{{--                <td>{{$PDFReports->mobile}}</td>--}}
                <td>{{$PDFReports->payment_method}}</td>
                {{--                                            <td>--}}
                {{--                                                <?php $admin_user =  \App\Admin::where('id', $order->admin_id)->first(); ?>--}}
                {{--                                                @if(!empty($admin_user))--}}
                {{--                                                    {{$admin_user->employee->name}}--}}
                {{--                                                @endif--}}
                {{--                                            </td>--}}
                <td>
                    @if($PDFReports->employee_id != 0)
                        {{\App\Employee::where('id', $PDFReports->employee_id)->first()->name}}
                    @endif
                </td>



            </tr>
        @endforeach
{{--        @foreach ($PDFReport as $PDFReports)--}}
{{--            <tr>--}}
{{--                <td>{{$PDFReports->id}}</td>--}}
{{--                <td>{{\Carbon\Carbon::parse($PDFReports->created_at)->toFormattedDateString()}}</td>--}}
{{--                <td>{{$PDFReports->name}}</td>--}}
{{--                <td>{{$PDFReports->user_email}}</td>--}}
{{--                <td>--}}
{{--                    @foreach($PDFReports->orders as $pro)--}}
{{--                        {{$pro->product_name}} - ({{$pro->product_qty}})--}}
{{--                        <br>--}}
{{--                    @endforeach--}}
{{--                </td>--}}
{{--                <td>NGN {{number_format($PDFReports->grand_total, 2)}}</td>--}}
{{--                <td>{{$PDFReports->amount_paid}}</td>--}}
{{--                <td>{{$PDFReports->balance}}</td>--}}
{{--                <td>NGN {{number_format($PDFReports->coupon_amount, 2)}}</td>--}}
{{--                <td>{{$PDFReports->payment_method}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>
</div>

<script src="{{asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/popper.min.js') }}"></script>
<script src="{{asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
