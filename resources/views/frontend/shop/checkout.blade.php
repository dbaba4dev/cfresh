@extends('frontend.layouts.master')
@push('css')
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">--}}
{{--    <link href="{{asset('frontend/css/bootstrap-iso.css')}}" rel="stylesheet">--}}
    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/shop.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/checkout.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/bootstrap-switch.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
@endpush
{{--@push('breadcrumb')--}}

{{--@endpush--}}
@section('page-title','Checkout')
@section('page-sub_title','Checkout')
@section('content')
<div class="margin-default">
    <div class="inner-page text-page">
        <div class="row">
            <div class="col-md-12 text-page">
                <article id="post-616" class="post-616 page type-page status-publish hentry">
                    <div class="entry-content clearfix" id="entry-div">
                        <div class="woocommerce">
                            <div class="woocommerce-notices-wrapper"></div>
                            <div class="woocommerce-form-login-toggle">
                                <div class="woocommerce-info">
                                    Returning customer? <span href="#" class="showlogin" style="color: #0b51c5; cursor: pointer">Click here to login</span>
                                </div>
                            </div>
                            <form class="woocommerce-form woocommerce-form-login login" id="chk_out_login" method="post" action="{{route('user.login')}}" style="display: none;">
                                @csrf
                                <p>
                                    If you have shopped with us before, please enter your details below. If you
                                    are a new customer, please proceed to the Billing &amp; Shipping section.
                                </p>
                                <p class="form-row form-row-first">
                                    <label for="username">Email&nbsp;<span class="required">*</span></label>
                                    <input type="text" class="input-text" name="email" id="email" autocomplete="email" />
                                </p>
                                <p class="form-row form-row-last">
                                    <label for="password">Password&nbsp;<span class="required">*</span></label>
                                    <input class="input-text" type="password" name="password" id="password" autocomplete="current-password" /></p>
                                <div class="clear"></div>
                                <p class="form-row">
                                    <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="baa0716537" />
                                    <input type="hidden" name="_wp_http_referer" value="/checkout/" />
                                    <input type="submit"  value="Sign In" />
                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                               name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                        <span>Remember me</span>
                                    </label>
                                </p>
                                <p class="lost_password">
                                    <a href="http://aquaterias.like-themes.com/my-account/lost-password/">Lost your password?</a>
                                </p>
                                <div class="clear"></div>
                            </form>
{{--                            <div class="woocommerce-form-coupon-toggle">--}}
{{--                                <div class="woocommerce-info">--}}
{{--                                    Have a coupon? <span class="showcoupon" style="color: #0b51c5; cursor: pointer">Click here to enter your code</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <form class="checkout_coupon woocommerce-form-coupon" id="coupon" method="post" style="display:none">--}}
{{--                                <p>If you have a coupon code, please apply it below.</p>--}}
{{--                                <p class="form-row form-row-first">--}}
{{--                                    <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value=""/>--}}
{{--                                </p>--}}
{{--                                <p class="form-row form-row-last">--}}
{{--                                    <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>--}}
{{--                                </p>--}}
{{--                                <div class="clear"></div>--}}
{{--                            </form>--}}

                            <div class="woocommerce-notices-wrapper" style="margin-bottom: 1rem; margin-top: 1rem"> @include('frontend.includes.msgs')</div>
                            <div class="clear"></div>

                            <div class="bootstrap-iso">

                                <form name="checkout" method="post" class="checkout woocommerce-checkout" id="payment-form" action="{{route('checkout')}}" >
                                    @csrf

                                    <input type="hidden" name="temp_email" id="temp_email" value="{{!empty($userDetail->email) ? $userDetail->email : ''}}">
                                    <div class="col2-set" id="customer_details">
                                        <div class="col-1">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Billing details</h3>
                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
                                                        <label for="billing_name" class="">Full name&nbsp;
                                                            <abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text " name="billing_name" id="billing_name"
                                                               placeholder=""  value="{{!empty($userDetail->name) ? $userDetail->name : old('billing_name')}}" autocomplete="given-name" required/>
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                                                        <label for="gender" class="">
                                                            Gender&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="hidden" name="switch_gender" id="switch_gender" value="{{!empty($userDetail->gender) ? $userDetail->gender : ''}}">
                                                       <input type="checkbox" id="gender" name="gender" data-toggle="toggle"

                                                              data-on-text="Male" data-off-text="Female"
                                                              data-on-color="primary" data-off-color="success" >
{{--                                                            <input type="checkbox" id="gender" name="gender" checked>--}}
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                        <label for="billing_company" class="">
                                                            Company name&nbsp;<span class="optional">(optional)</span>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="text"  class="input-text " name="billing_company" id="billing_company"
                                                               placeholder="" value="{{!empty($userDetail->company_name) ? $userDetail->company_name : old('billing_company')}}" autocomplete="organization" />
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                                                       id="billing_state_field" data-priority="40">
                                                        <label for="billing_state" class="">
                                                            State&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <select name="billing_state" id="billing_state" class="state_select" autocomplete="state" required>
                                                            <option value="">Select a State&hellip;</option>
                                                             @foreach($states as $state)
                                                                <option value="{{$state->id}}"
                                                                        @if(!empty($userDetail->state))
                                                                        @if($userDetail->state->id == $state->id)
                                                                        selected
                                                                            @endif
                                                                    @endif
                                                                        >{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <noscript>
                                                            <button type="submit" name="woocommerce_checkout_update_totals" value="Update state">
                                                                Update State
                                                            </button>
                                                        </noscript>
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide address-field validate-required validate-state" id="billing_state_field" data-priority="80">
                                                        <label for="lga" class="">
                                                            Local Government Area &nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <select name="billing_lga" id="lga" class="lga_select " >
                                                            <option value="">Select an option&hellip;</option>
                                                             @foreach($lgas as $lga)
                                                                @if(!empty($userDetail->lga))
                                                                    <option value="{{$lga->id}}"
                                                                            @if($userDetail->lga->id == $lga->id)
                                                                            selected
                                                                            @endif
                                                                        >{{$lga->name}}
                                                                    </option>
                                                                @else
                                                                    <option value="{{$lga->id}}">{{$lga->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select >
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="50">
                                                        <label for="billing_address_1" class="">
                                                            Address&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text " name="billing_address_1" id="billing_address_1"
                                                               placeholder="House number and street name" value="{{!empty($userDetail->address) ? $userDetail->address : old('billing_address_1')}}" autocomplete="address-line1" required/>
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                        <label for="billing_phone" class="">
                                                            Phone&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder=""
                                                               value="{{!empty($userDetail->mobile) ? $userDetail->mobile : old('billing_phone')}}" autocomplete="tel" required/>
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide dob-field" id="dob_field" data-priority="60">
                                                        <label for="dob" class="">
                                                            Date of Birth&nbsp;<span class="optional">(optional)</span>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="date" class="input-text " name="dob" id="dob"
                                                                value="{{!empty($userDetail->dob) ? $userDetail->dob : old('dob')}}"  />
                                                    </span>
                                                    </p>
                                                    <p class="form-row form-row-wide address-field validate-required" id="religion_field" data-priority="70">
                                                        <label for="religion" class="">
                                                            Religion&nbsp;<span class="optional">(optional)</span>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <select name="religion" id="religion" class="religion_select " autocomplete="religion" data-placeholder="" >
                                                            <option value="">Select an option&hellip;</option>
                                                            <option value="Christian" {{!empty($userDetail->religion) ? $userDetail->religion == 'Christian' ? 'selected' : '' : ''}}>Christian</option>
                                                            <option value="Islam" {{!empty($userDetail->religion) ? $userDetail->religion == 'Islam' ? 'selected' : '' : ''}}>Islam</option>
                                                            <option value="Others" {{!empty($userDetail->religion) ? $userDetail->religion == 'Others' ? 'selected' : '' : ''}}>Others</option>
                                                        </select>
                                                        </span>
                                                    </p>
{{--                                                    <p class="form-row form-row-wide address-field validate-postcode" id="billing_postcode_field" data-priority="90">--}}
{{--                                                        <label for="billing_postcode" class="">--}}
{{--                                                            Postcode&nbsp;<span class="optional">(optional)</span>--}}
{{--                                                        </label>--}}
{{--                                                        <span class="woocommerce-input-wrapper">--}}
{{--                                                        <input type="text" class="input-text " name="billing_postcode" id="billing_postcode"--}}
{{--                                                               placeholder="" value="" autocomplete="postal-code" />--}}
{{--                                                    </span>--}}
{{--                                                    </p>--}}

                                                    <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field" data-priority="110">
                                                        <label for="billing_email" class="">
                                                            Email address&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="email" class="input-text " name="billing_email" id="billing_email"
                                                               placeholder="" value="{{old('billing_email')}}" autocomplete="email username" required/>
                                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="woocommerce-account-fields">
                                                <div class="create-account">
                                                    <p class="form-row validate-required" id="account_password_field" data-priority="">
                                                        <label for="account_password" class="">
                                                            Create account password&nbsp;<abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <input type="password" class="input-text " name="password"
                                                               id="account_password" placeholder="Password" value="" required/>
                                                    </span>
                                                    </p>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="woocommerce-shipping-fields"></div>
                                            <div class="woocommerce-additional-fields">
                                                <h3>Additional information</h3>
                                                <div class="woocommerce-additional-fields__field-wrapper">
                                                    <p class="form-row notes" id="order_comments_field" data-priority="">
                                                        <label for="order_comments" class="">
                                                            Order notes&nbsp;<span class="optional">(optional)</span>
                                                        </label>
                                                        <span class="woocommerce-input-wrapper">
                                                        <textarea name="order_comments" class="input-text" id="order_comments"
                                                                  placeholder="Notes about your order, e.g. special notes for delivery."
                                                                  rows="2" cols="5">
                                                        </textarea>
                                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 id="order_review_heading">Your order</h3>
                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr class="cart_item">
                                                    <td class="product-name"> {{$product['item']->case}}&nbsp;
                                                        <strong class="product-quantity">&times; {{$product['qty']}}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                    {{number_format($product['price'], 2)}}
                                                </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                    {{number_format($total, 2)}}
                                                </span>
                                                </td>
                                            </tr>
                                            @if(Session::has('couponAmount'))
                                                <tr class="cart-discount">
                                                    <th>Discount</th>
                                                    <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                    {{number_format(Session::get('couponAmount'),2)}}
                                                </span>
                                                    </td>
                                                </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                        {{number_format(($total-Session::get('couponAmount')), 2)}}
                                                    </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            @else
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">&#8358</span>
                                                        {{number_format($total, 2)}}
                                                    </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            @endif
                                            </tfoot>
                                        </table>
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <ul class="wc_payment_methods payment_methods methods">
                                                <li class="wc_payment_method payment_method_bacs">
                                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method"
                                                           value="bacs"  data-order_button_text="" />
                                                    <label for="payment_method_bacs"> Direct bank transfer </label>
                                                    <div class="payment_box payment_method_bacs" id="db_transfer" style="display:none;">
                                                        <p>
                                                            Make your payment directly into our bank account. Please
                                                            use your Order ID as the payment reference. Your order
                                                            will not be shipped until the funds have cleared in our
                                                            account.
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="wc_payment_method payment_method_cheque">
                                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method"
                                                           value="cheque" data-order_button_text="" />
                                                    <label for="payment_method_cheque"> Check payments </label>
                                                    <div class="payment_box payment_method_cheque" id="cheque_transfer" style="display:none;">
                                                        <p>
                                                            Please send a check to Store Name, Store Street, Store
                                                            Town, Store State / County, Store Postcode.
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="wc_payment_method payment_method_cod">
                                                    <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method"
                                                           value="Cash On Delivery" data-order_button_text="" checked="checked" />
                                                    <label for="payment_method_cod"> Cash on delivery </label>
                                                    <div class="payment_box payment_method_cod" id="cod_transfer">
                                                        <p>Pay with cash upon delivery.</p>
                                                    </div>
                                                </li>
                                                <li class="wc_payment_method payment_method_paypal">
                                                    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method"
                                                           value="card" data-order_button_text="Proceed to PayPal" />
                                                    <label  for="payment_method_paypal">
                                                        Credit or debit card
{{--                                                        <img src="{{asset('frontend/wp-content/uploads/2018/01/paypal.jpg')}}" alt="PayPal acceptance mark" />--}}
{{--                                                        <a href="https://www.paypal.com/us/webapps/mpp/paypal-popup" class="about_paypal"--}}
{{--                                                           onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal','toolbar=no,' +--}}
{{--                                                        'location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700');--}}
{{--                                                       return false;">What is PayPal?--}}
{{--                                                        </a>--}}
                                                    </label>

                                                    <div class="payment_box payment_method_paypal" id="paypal_transfer" style="display:none;">
{{--                                                        <p>Pay via PayPal; you can pay with your credit card if you  don&#8217;t have a PayPal account.</p>--}}
                                                        <div id="charge-error" class="alert alert-danger {{!Session::has('error') ? 'hidden' : ''}}">
                                                            {{Session::get('error')}}
                                                        </div>

                                                        <div lass="links" id="checkout-pay">
                                                            @csrf
                                                            <script src="https://js.stripe.com/v3/"></script>

                                                            {{--                                                                <form action="{{route('stripe.store')}}" method="post" id="payment-form">--}}
                                                            {{--                                                                    @csrf--}}
                                                            <div class="form-row" id="payment-form">
{{--                                                                <label for="card-element">Credit or debit card</label>--}}
                                                                <div id="card-element">
                                                                    <!-- A Stripe Element will be inserted here. -->
                                                                </div>

                                                                <!-- Used to display form errors. -->
                                                                <div id="card-errors" role="alert"></div>
                                                            </div>

                                                           <button id="st-btn" disabled><i class="fa fa-arrow-left"></i> Enter your Card information here. </button>
                                                            {{--                                                                </form>--}}
                                                        </div>

                                                    </div>

                                                </li>
                                            </ul>
                                            <div class="form-row place-order">
                                                <noscript> Since your browser does  not support JavaScript, or it is disabled, please ensure you
                                                    click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated
                                                    above if you fail to do so. <br />
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" alue="Update totals">
                                                        Update totals
                                                    </button>
                                                </noscript>
                                                <div class="woocommerce-terms-and-conditions-wrapper">
                                                    <div class="woocommerce-privacy-policy-text"></div>
                                                </div>
                                                <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order"
                                                        value="Place order" data-value="Place order">
                                                    Place order
                                                </button>
                                                <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="7f89723cb6" />
                                                <input type="hidden" name="_wp_http_referer" value="/checkout/" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

@endsection
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

        jQuery(function($) {
            $("[name='gender']").bootstrapSwitch();

            var log_in = $('#temp_email').val();

            if(log_in != '')
            {
                $('#billing_email')
                    .attr('required', false);
                $('#billing_email_field').hide();

                $('#account_password')
                    .attr('required', false);
                $('#account_password_field').hide();
            }

            $('.showlogin').on('click', function () {
                $('#chk_out_login').toggle('slow');
            });
            $('.showcoupon').on('click', function () {
                $('#coupon').toggle('slow');
            });

            $('#payment_method_bacs').on('change', function () {

                 $('#db_transfer').toggle('slow');

            });
            $('#payment_method_cheque').on('change', function () {
                $('#cheque_transfer').toggle('slow');
            });
            $('#payment_method_cod').on('change', function () {
                $('#cod_transfer').toggle('slow');
            });
            $('#payment_method_paypal').on('change', function () {
                $('#paypal_transfer').toggle('slow');
                if($("input[name='payment_method']").val == 'card')
                {
                    // alert('Yee! Paypal');

                }else
                {
                    // alert('No, not Paypal');
                    // Create a Stripe client.
                    var stripe = Stripe('pk_test_51H1v2MKbjSlRmlmYkMKD26sxbZUSLWKQ2nvGF2acZfxWq8a6NlzcyxaJIykqvlAKi7L5gVDZnIhpDNIeA8IzREzT00XOV5husA');

                    // Create an instance of Elements.
                    var elements = stripe.elements();

                    // Custom styling can be passed to options when creating an Element.
                    // (Note that this demo uses a wider set of styles than the guide below.)
                    var style = {
                        base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    };

                    // Create an instance of the card Element.
                    var card = elements.create('card', {style: style});

                    // Add an instance of the card Element into the `card-element` <div>.
                    card.mount('#card-element');

                    // Handle real-time validation errors from the card Element.
                    card.addEventListener('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    // Handle form submission.
                    var form = document.getElementById('payment-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        stripe.createToken(card).then(function(result) {
                            if (result.error) {
                                // Inform the user if there was an error.
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                // Send the token to your server.
                                stripeTokenHandler(result.token);
                            }
                        });
                    });

                    // Submit the form with the token ID.
                    function stripeTokenHandler(token) {
                        // Insert the token ID into the form so it gets submitted to the server
                        var form = document.getElementById('payment-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', token.id);
                        form.appendChild(hiddenInput);

                        // Submit the form
                        form.submit();
                    }
                }
            });

            if($('#switch_gender').val()=='Male')
            {
                $('#gender').bootstrapSwitch('state',true);
            }
            if($('#switch_gender').val()=='Female')
            {
                $('#gender').bootstrapSwitch('state',false);
            }

            $('#gender').on('switchChange.bootstrapSwitch', function () {
                var action = $(this).bootstrapSwitch('state');
                // alert(action);
                if(action)
                {
                    $("input[name='gender']").val('Male');
                }else
                {
                    $("input[name='gender']").val('Female');
                }
            });

        });


        jQuery(document).ready(function ()
        {
            jQuery('select[name="billing_state"]').on('change',function(){
                var stateID = jQuery(this).val();
                if(stateID)
                {
                    jQuery.ajax({
                        url : 'state/' +stateID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('select[name="billing_lga"]').empty();
                            jQuery.each(data, function(key,value){
                               jQuery('select[name="billing_lga"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }
                else
                {
                    $('select[name="billing_lga"]').empty();
                }
            });

            // $('#chk_out_login').on('submit', function (e) {
            //     e.preventDefault();
            //     alert('Annna');
            // });

            // jQuery('#gender').change(function () {
            // jQuery('select[name="gender"]').on('change',function(){
            //     alert('Deeeee');
            //     var action = $(this).prop('checked');
            //     alert(action);
            //     if(action)
            //     {
            //         $("input[name='gender']").val('Male');
            //     }else
            //     {
            //         $("input[name='gender']").val('Female');
            //     }
            // });

        });

    </script>

    <script>

    </script>

@endpush
