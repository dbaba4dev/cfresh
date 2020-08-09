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
    <style>
        /*.footer .page-number:after { content: counter(page); }*/
        /*@page {*/
        /*    margin: 100px 25px;*/
        /*}*/
        /*footer {*/
        /*    position: fixed;*/
        /*    bottom: -10px;*/
        /*    left: 0;*/
        /*    right: 0;*/
        /*    height: 50px;*/

        /*    !** Extra personal styles **!*/
        /*    background-color: #03a9f4;*/
        /*    color: white;*/
        /*    text-align: center;*/
        /*    line-height: 35px;*/
        /*}*/
        /*footer {*/
        /*    color: #5D6975;*/
        /*    width: 100%;*/
        /*    height: 30px;*/
        /*    position: absolute;*/
        /*    bottom: 0;*/
        /*    border-top: 1px solid #C1CED9;*/
        /*    padding: 8px 0;*/
        /*    text-align: center;*/
        /*}*/
    </style>
</head>

<body >
<header class="clearfix" style="padding-bottom: -0.2rem; ">
    <div id="logo" style="text-align: center; padding-bottom: -1rem">

        <img src="data:image/png;base64, {{base64_encode(@file_get_contents(asset('images/logo/Cfresh-label.png')))}}" height="100px" width="100px"><br><br>
        <h3 class="text-bold text-primary">Summary of Stored Products </h3>
        <br><br>
    </div>
{{--   <div class="container">--}}
       <div class="row" style="margin-top: 0.5rem;" >
           <div class="float-left col-md-6" style="width: 350px">
               <table class="table table-bordered  table-sm" style="font-size: 12px">
                   <tr >
                       <td style="background-color: darkred; color: white;"><strong>Statement Period</strong></td>
                       <td>{{\Carbon\Carbon::parse($from)->toFormattedDateString()}} to {{\Carbon\Carbon::parse($to)->toFormattedDateString()}}</td>
                   </tr>

                   @for($i = $first; $i<=$last; $i++)
                       <tr>
                           <td style="background-color: darkred; color: white;"><strong>In flow ({{\App\Box::where('id',$i)->first()->case}})</strong></td>
                           <td>{{number_format($in_flow['prod'.$i], 0)}}</td>
                       </tr>
                       <tr>
                           <td style="background-color: darkred; color: white;"><strong>Out flow ({{\App\Box::where('id',$i)->first()->case}})</strong></td>
                           <td>{{number_format($out_flow['prod'.$i], 0)}}</td>
                       </tr>                   &nbsp;
                   @endfor

                   <tr>
                       <td class="text-center" style="background-color: darkred; color: white;" colspan="2"><strong>Remaining Products</strong></td>
                   </tr>

                   @for($i = $first; $i<=$last; $i++)
                       <tr>
                           <td style="background-color: darkred; color: white;"><strong>Opening balance ({{\App\Box::where('id',$i)->first()->case}})</strong></td>
                           <td>
                               {{number_format($balance_opening['prod'.$i],0)}}
                           </td>
                       </tr>
                       <tr>
                           <td style="background-color: darkred; color: white;"><strong>Closing balance ({{\App\Box::where('id',$i)->first()->case}})</strong></td>
                           <td>
                               {{number_format($balance_closing['prod'.$i],0)}}
                           </td>
                       </tr>
                   @endfor

                   {{--                @foreach($cases as $case)--}}

                   {{--                @endforeach--}}
                   {{--                <tr>--}}
                   {{--                    <td style="background-color: darkred; color: white;"><strong>In flow</strong></td>--}}
                   {{--                    <td>{{number_format($in_flow, 2)}}</td>--}}
                   {{--                </tr>--}}
                   {{--                <tr>--}}
                   {{--                    <td style="background-color: darkred; color: white;"><strong>Out flow</strong></td>--}}
                   {{--                    <td>{{number_format($out_flow, 2)}}</td>--}}
                   {{--                </tr>--}}
               </table>
           </div>
                   <div class="col"></div>
           <div class="float-right col-md-6" >
               <table class="table table-borderless table-sm" >
                   <tr>
                       <td><span style="color: darkred; font-size: 14px;  text-align: right"><strong><h3>{{$settings->site_name}}</h3></strong></span></td>
                   </tr>
                   <tr>
                       <td style="font-size: 12px; color: #cccccc; text-align: right; padding-top: -0.2rem  ">{{$settings->contact_address}}</td>
                   </tr>
                   <tr>
                       <td style="font-size: 12px; color: #cccccc;  text-align: right; padding-top: -0.5rem ">{{$settings->contact_email}}-({{$settings->contact_number}})</td>
                   </tr>
               </table>


           </div>
       </div>
{{--   </div>--}}
</header>
<div class="table-responsive" style="padding-top: -0.2rem">
    <table class="table table-striped table-bordered" style='background:  url("data:image/png;base64, {{base64_encode(@file_get_contents(asset('images/logo/dimension.png')))}}"); font-size: 12px' >
        <thead>
        <tr style="background-color: darkred; color: white; font-size: 12px">
            <th>Date</th>
            <th>Time</th>
            <th>Quantities </th>
            <th>Case Type</th>
            <th>Employee</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($PDFReport as $product)
            <tr>
                <td>{{\Carbon\Carbon::parse($product->created_at)->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($product->created_at)->format('H:i:s A')}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->box->case}}</td>
                <td>{{!empty($product->employee->name) ? $product->employee->name : ''}}</td>
{{--                <td>{{$product->balance}}</td>--}}

                @if($product->flow == 'In flow')
                    <td style="background: darkblue; color: white"><strong>{{$product->flow}}</strong></td>
                @else
                    <td style="background: darkslategrey; color: white"><strong>{{$product->flow}}</strong></td>
                @endif



            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<footer>

<script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->getFont("Times", "bold");
            $color = array(0,0,0);
            $w = $pdf->get_width();
            $h = $pdf->get_height();

{{--            // Draw a line along the bottom--}}
{{--            $y = $h - 25;--}}
{{--            $pdf->line(15, $y, $w - 15, $y, $color, 1);--}}
            $pdf->page_text(30, 810, "{{\Carbon\Carbon::parse(today())->toFormattedDateString()}}-({{\Carbon\Carbon::parse(now())->format('h:i A')}})", $font, 6, array(0,0,1));
            $pdf->page_text(270, 810, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 6, $color);
            $pdf->page_text(530, 810, "cfresh.com", $font, 8, array(0,0,1));
        }
</script>

</footer>


<script src="{{asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/popper.min.js') }}"></script>
<script src="{{asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
