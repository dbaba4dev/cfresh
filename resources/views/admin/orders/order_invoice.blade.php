<link rel="stylesheet" href="{{asset('css/frontend_css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/styles.css')}}">
<script src="{{asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('assets/libs/popper.js/dist/popper.min.js') }}"></script>
<script src="{{asset('frontend/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2>
                <span style="margin-left: 40rem"> <img src="{{asset('images/logo/cfresh1.jpg')}}" style="width: 40px" alt="logo"><strong style="color: darkblue;  font-size: 18px; font-family: 'Bookman Old Style'">- Fresh</strong> </span>
                <h3 class="pull-right">Order # {{$orderDetails->id}}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        {{$billingsDetails->name}} <br>
                        {{$billingsDetails->address}} <br>
                        {{$billingsDetails->lga->name}} <br>
                        {{$billingsDetails->state->name}} <br>
                        {{$billingsDetails->pincode}} <br>
                        {{$billingsDetails->mobile}} <br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
						@if(!empty($shippingDetails->name))
							{{$shippingDetails->name}} <br>
							{{$shippingDetails->address}} <br>
							{{$shippingDetails->lga->name}} <br>
							{{$shippingDetails->state->name}} <br>
							{{$shippingDetails->pincode}} <br>
							{{$shippingDetails->mobile}} <br>
						@endif
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        {{$orderDetails->payment_method}}
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{\Carbon\Carbon::parse($orderDetails->created_at)->toFormattedDateString()}} - ({{\Carbon\Carbon::parse($orderDetails->created_at)->format('h:i A')}})<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Product Name</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $subTotal = 0; ?>
                            @foreach($orderDetails->orders as $order)
                                <tr>
                                    <td>{{$order->product_name}}</td>
                                    <td class="text-center">&#8358 {{$order->product_price}}</td>
                                    <td class="text-center">{{$order->product_qty}}</td>
                                    <td class="text-right">&#8358 {{$order->product_qty*$order->product_price}}</td>
                                </tr>
                                <?php $subTotal =$subTotal + $order->product_qty*$order->product_price; ?>
                            @endforeach
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-right"><strong>Subtotal:</strong></td>
                                <td class="thick-line text-right">&#8358 {{number_format($subTotal, 2)}}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td class="no-line"></td>--}}
{{--                                <td class="no-line"></td>--}}
{{--                                <td class="no-line text-center"><strong>Shipping Charges (+):</strong></td>--}}
{{--                                <td class="no-line text-right">$ 0</td>--}}
{{--                            </tr>--}}

                            @if($orderDetails->coupon_amount > 0)
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Coupon Discount (-):</strong></td>
                                    <td class="no-line text-right">&#8358 {{$orderDetails->coupon_amount}}</td>
                                </tr>

                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Grand Total:</strong></td>
                                    <td class="no-line text-right"><strong>&#8358 {{$orderDetails->grand_total}}</strong></td>
                                </tr>
                            @else
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Grand Total:</strong></td>
                                    <td class="no-line text-right"><strong>&#8358 {{$orderDetails->grand_total}}</strong></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
