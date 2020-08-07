@extends('frontend.layouts.master')
@push('css')
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">--}}
    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/shop.css')}}" rel="stylesheet">

@endpush
{{--@push('breadcrumb')--}}

{{--@endpush--}}
@section('page-title','Shopping Cart')
@section('page-sub_title','Cart')
@section('content')
{{--    <div class="container">--}}
        <div class="margin-default">
            <div class="inner-page text-page">
                <div class="row">
                    <div class="col-md-12 text-page">
                        <article id="post-615" class="post-615 page type-page status-publish hentry">
                            <div class="entry-content clearfix" id="entry-div">
                                <div class="woocommerce">
                                    <div class="woocommerce-notices-wrapper"></div>
                                    <div class="bootstrap-iso">
                                        @include('frontend.includes.message')
                                        @if(Session::has('cart'))
                                            <form class="woocommerce-cart-form" action="{{route('apply.coupon')}}" method="post">
                                                @csrf
                                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"  id="shop_cart"
                                                    cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th class="product-remove">&nbsp;</th>
                                                        <th class="product-thumbnail">&nbsp;</th>
                                                        <th class="product-name">Product</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product-quantity">Quantity</th>
                                                        <th class="product-subtotal">Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="cartList">
                                                    @foreach($products as $product)
                                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                                        <td class="product-remove">
                                                            <a href="" class="remove" aria-label="Remove this item" >&times;</a>
                                                        </td>
                                                        <td class="product-thumbnail">
                                                            <a href="">
                                                                <img width="50px" height="60px" src="{{asset('images/backends_images/products/'.$product['item']->image)}}"
                                                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                                    alt=""/>
                                                            </a>
                                                        </td>
                                                        <td class="product-name" data-title="Product">
                                                            <a href="">
                                                                {{$product['item']->case}}
                                                            </a>
                                                        </td>
                                                        <td class="product-price" data-title="Price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol"> &#8358</span>
                                                                {{number_format($product['item']->price, 2)}}
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity" data-title="Quantity">
                                                            <div class="quantity">
                                                                <label class="screen-reader-text" for="quantity_5ef5f92dd19e5">Quantity</label>
                                                                <input type="hidden" name="oldQty" id="oldQty_{{$product['item']->id}}" value="{{$product['qty']}}">
                                                                <input type="number" rel="{{$product['item']->id}}" id="quantity_{{$product['item']->id}}" class="input-text qty text" step="1" min="0" max=""
                                                                    name="qty[]"  value="{{$product['qty']}}" title="Qty" size="4" pattern="[0-9]*"
                                                                    inputmode="numeric" />
                                                            </div>
                                                        </td>
                                                        <td class="product-subtotal" data-title="Total">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                                {{number_format($product['price'], 2)}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="6" class="actions">
                                                            <div class="row">
                                                                <div class="coupon col-sm-4">
{{--                                                                    <label for="coupon_code">Coupon:</label>--}}
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="coupon_code" class="input-text"
                                                                               id="coupon_code" value="" placeholder="Coupon code" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button type="submit" class="button" name="apply_coupon"
                                                                                value="Apply coupon">Apply coupon
                                                                        </button>
                                                                    </div>


                                                                </div>
                                                                <div class="col-sm-4"></div>
                                                                <div class="col-sm-4">
                                                                    <a type="button" href="{{route('cart')}}" class="button" name="update_cart" id="update_cart" value="Update cart" disabled>
                                                                        Update cart
                                                                    </a>
                                                                </div>

                                                            </div>

{{--                                                            <input type="hidden" id="woocommerce-cart-nonce" name="woocommerce-cart-nonce" value="b2cd7a972d" />--}}
{{--                                                            <input type="hidden" name="_wp_http_referer" value="/cart/" />--}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                            <div class="cart-collaterals" style="margin-top: 0;" >
                                                <div class="cart_totals calculated_shipping">
                                                    <h2>Cart totals</h2>
                                                    <div class="bootstrap-iso">
                                                        <table cellspacing="1" class="table prod_title" style="width: 20rem; border: none">
                                                            <tr class="cart-subtotal" style="border: none; ">
                                                                <td style="border: none; font-size: 20px">Subtotal</td>
                                                                <td data-title="Subtotal" style="border: none; font-size: 16px">
                                                                <span class="woocommerce-Price-amount amount" style="font-weight: bold">
                                                                    <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                                   {{number_format($totalPrice,2)}}
                                                                </span>
                                                                </td>
                                                            </tr>
                                                            @if(Session::has('couponAmount'))
                                                                <tr class="cart-subtotal" style="border: none; ">
                                                                    <td style="border: none; font-size: 20px;  background: none" >Discount</td>
                                                                    <td data-title="Subtotal" style="border: none; font-size: 16px;  background: none">
                                                                    <span class="woocommerce-Price-amount amount" style="font-weight: bold">
                                                                        <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                                       {{number_format(Session::get('couponAmount'),2)}}
                                                                    </span>
                                                                    </td>
                                                                </tr>
                                                                <tr class="order-total my-1" style=" border-top: 1px solid lightblue" >
                                                                    <th style="border: none; background: none; font-size: 28px">Total</th>
                                                                    <td data-title="Total" style="font-size: 28px;  font-weight: bold; border: none; background: none">
                                                                        <strong><span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                                        {{number_format(($totalPrice-Session::get('couponAmount')),2)}}
                                                                    </span>
                                                                        </strong>
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr class="order-total my-1" style=" border-top: 1px solid lightblue" >
                                                                    <th style="border: none; background: none; font-size: 28px">Total</th>
                                                                    <td data-title="Total" style="font-size: 28px;  font-weight: bold; border: none; background: none">
                                                                        <strong><span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                                        {{number_format($totalPrice,2)}}
                                                                    </span>
                                                                        </strong>
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        </table>
                                                    </div>

                                                    <div class="wc-proceed-to-checkout">
                                                        <a href="{{route('checkout')}}"
                                                            class="checkout-button button alt wc-forward">
                                                            Proceed to checkout
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="cart-empty" style="color: #0b51c5;">Your cart is currently empty.</p>
                                            <p class="return-to-shop">
                                                <a class="button wc-backward" href="{{route('shop')}}">
                                                    Return to shop
                                                </a>
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}
@endsection
@push('script')
    <script type='text/javascript' src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <script>
        jQuery(function($) {

            $(".qty").on('change', function () {
                var pid = $(this).attr('rel');
                var qty = $('#quantity_'+pid).val();
                $('#update_cart').attr('disabled',false);
                var tr = $(this).parent().parent();
                $.ajax({
                    url: 'add-more-cart/'+pid+'/'+qty,
                    method: 'get',
                    dataType: 'json',
                    data: {qty:qty, id:pid},
                    success: function (data) {
                        console.log(data);
                        // tr.find('.tqty').val(data['balance']);
                        // tr.find('.pro_name').val(data['box']['case']);
                        // tr.find('.qty').val(1);
                        // tr.find('.price').val(data['box']['price']);
                        // tr.find('.amt').html(tr.find('.qty').val()*tr.find('.price').val());
                        // calculate(0,0);
                    }
                });





            });
        });





        // function calculate(dis, paid) {
        //     $('#coupon_code').val(0);
        //     var sub_total = 0;
        //     var net_total = 0;
        //     var discount = dis;
        //     var amt_paid = paid;
        //     var balance = 0;
        //     $('.amt').each(function () {
        //         sub_total = sub_total + ($(this).html()*1);
        //     });
        //
        //     net_total =sub_total + net_total - discount;
        //     balance = net_total - amt_paid;
        //
        //     $('#sub_total').val(sub_total);
        //     $('#discount').val(discount);
        //     $('#net_total').val(net_total);
        //     // $('#paid')
        //     $('#balance').val(balance);
        // }
    </script>




@endpush
