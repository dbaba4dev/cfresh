<?php $settings = \App\Setting::find(1);  ?>
<html>
<head>
    <title>Order Email</title>
    <link href="{{asset('css/frontend_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/prettyPhoto.css')}}" rel="stylesheet">
</head>
<body>
<table width="700px">
    <tr><td></td></tr>
    <tr><td><img src="{{ asset('images/logo/cfresh1.jpg') }}" alt="logo"><a href="{{ asset('frontend/img/logo/cfresh1.jpg') }}"><strong style="color: #0d374a">-Fresh</strong></a></td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Hello: {{$name}} </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Thank you for shopping with us. Your order details are as below:- </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Order No: #{{ $order_id }}</td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>
            <table class="table table-responsive table-bordered" style="width: 70%; background-color: lightgrey">
                <tr style=" background-color: #cccccc">
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                </tr>
                @foreach($productDetails['orders'] as $product)
                    <tr>
                        <td style="text-align: center">{{$product['product_name']}}</td>
                        <td style="text-align: center">{{$product['product_qty']}}</td>
                        <td style="text-align: center">NGN {{$product['product_price']}}</td>
                    </tr>
                @endforeach
                <tr >
                    <td colspan="5" align="right">Shipping Charges: </td>
                    <td><strong>NGN {{$productDetails['shipping_charges']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Coupon Discount: </td>
                    <td><strong>NGN {{$productDetails['coupon_amount']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Grand Total: </td>
                    <td><strong>NGN {{$productDetails['grand_total']}}</strong></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    <tr><td>&nbsp; </td></tr>
    <tr>
        <td>
            <table class="table" style="width: 100%">
                <tr>
                    <td style="width: 50%">
                        <table class="table">
                            <tr>
                                <td><strong>Bill TO:-</strong></td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['name']}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['address']}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['lga']}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['state']}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['pincode']}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails['mobile']}}</td>
                            </tr>

                        </table>
                    </td>
                    <td style="width: 50%">
                        <table class="table">
                            <tr>
                                <td><strong>Deliver TO:-</strong></td>
                            </tr>
                            <tr>
                                <td>{{$userDetail['name']}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetail['address']}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetail->lga->name}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetail->state->name}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetail['pincode']}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetail['mobile']}}</td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
    </tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>For any enquiries, you can contact us at <a href="mailto:info@cfresh-website.com">info@cfresh-website.com</a> </td></tr>
    <tr><td>&nbsp; </td></tr>
    <tr><td>Regards, <br>Team {{$settings->site_name}} </td></tr>
</table>
</body>
<script src="{{asset('js/frontend_js/jquery.js')}}"></script>
<script src="{{asset('js/frontend_js/bootstrap.min.js')}}"></script>
</html>
