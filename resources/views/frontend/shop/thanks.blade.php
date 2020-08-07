<?php $tot_amount = 0; $total_qty = 0; $userCart = Session::get('cart');
$coupon_amount = number_format($orderDetail->coupon_amount,2);
$pay_method = $orderDetail->payment_method;
$grand_tot = number_format(Session::get('grand_total'),2);

?>
@extends('frontend.layouts.master')
@push('css')
    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/shop.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/bootstrap-switch.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endpush

@section('page-title','Thanks')
@section('page-sub_title','Thanks')
@section('content')

    <div class="margin-default">
        <div class="inner-page text-page">
            <div class="row">
                <div class="col-md-12 text-page">
                    <article id="post-616" class="post-616 page type-page status-publish hentry">
                        <div class="entry-content clearfix" id="entry-div">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper" style="margin-bottom: 1rem; margin-top: 1rem"> @include('frontend.includes.msgs')</div>
                                <div class="woocommerce-order">
                                    <p
                                        class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                                        Thank you. Your order has been received.</p>
                                    @if(Session::has('cart'))
                                        <ul
                                            class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                            <li class="woocommerce-order-overview__order order"> Order number:
                                                <strong> {{Session::get('order_id')}}</strong></li>
                                            <li class="woocommerce-order-overview__date date"> Date: <strong>{{\Carbon\Carbon::parse(now())->toFormattedDateString()}}</strong></li>
                                            <li class="woocommerce-order-overview__total total"> Total: <strong><span
                                                        class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">&#8358</span>{{$grand_tot}}</span></strong>
                                            </li>
                                            <li class="woocommerce-order-overview__payment-method method"> Payment
                                                method: <strong>{{$pay_method}}</strong></li>
{{--                                                method: <strong>{{!empty($orderDetail->payment_method) ? $orderDetail->payment_method : 'Card' }}</strong></li>--}}
                                        </ul>
                                        <section class="woocommerce-order-details">
                                            <h2 class="woocommerce-order-details__title">Order details</h2>

                                            <table
                                                class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                                <thead>
                                                <tr>
                                                    <th class="woocommerce-table__product-name product-name">Product
                                                    </th>
                                                    <th class="woocommerce-table__product-table product-total">Total
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach($userCart->items as $cart)
                                                        <tr class="woocommerce-table__line-item order_item">
                                                            <td class="woocommerce-table__product-name product-name">
                                                                <a href=""> {{$cart['item']->case}}</a> <strong class="product-quantity">&times; {{$cart['qty']}}</strong>
                                                            </td>
                                                            <td class="woocommerce-table__product-total product-total">
                                                               <span class="woocommerce-Price-amount amount">
                                                                   <span class="woocommerce-Price-currencySymbol">&#8358</span>{{number_format($cart['price'],2)}}</span>
                                                            </td>
                                                        </tr>
                                                        <?php $total_qty = $total_qty + $cart['qty']; ?>
                                                        <?php $tot_amount = $tot_amount + $cart['price']; ?>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th scope="row">Subtotal:</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">&#8358</span>{{number_format($tot_amount,2)}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Coupon Discount (-):</th>
                                                    <td>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">&#8358</span>{{$coupon_amount}} </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Payment method:</th>
                                                    <td>{{$pay_method}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total:</th>
                                                    <td><span class="woocommerce-Price-amount amount">
                                                            <span  class="woocommerce-Price-currencySymbol">&#8358</span>{{$grand_tot}}</span>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>

                                        </section>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

@endsection
<?php
//Session::forget('order_id');
//Session::forget('grand_total');
//Session::forget('session_id');
Session::flush();
?>
@section('scripting')
    <script type='text/javascript' src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/js/bootstrap-switch.js') }}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script type='text/javascript' src="{{asset('frontend/js/script_check.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
@endsection

@push('script')
    <script>




    </script>



@endpush
