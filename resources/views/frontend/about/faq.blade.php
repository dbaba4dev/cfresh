@extends('frontend.layouts.master')
@push('css')
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">--}}

    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/faq.css')}}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
<script type='text/javascript' src="{{ asset('frontend/js/bootstrap.js') }}"></script>
@endpush
{{--@push('breadcrumb')--}}

{{--@endpush--}}
@section('page-title','Frequently Asked Questions')
@section('page-sub_title','Frequently Asked Questions')
@section('content')
    <div class="container">
        <div class="faq-list inner-page margin-default">
            <div class="bootstrap-iso">
            <button class="accordion " >Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">Is it possible to pay by credit card?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">What payment methods exist in your company?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">Can I return the product after purchase? </button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">How do I use a Coupon code?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">What is the validity period of the gift certificate?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">What if the prepaid goods are not delivered?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">Where and how can I exchange or refund?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>

            <button class="accordion">Is it possible to pay by credit card?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            <button class="accordion">Is it possible to pay for an order with Visa and MasterCard payment cards?</button>
            <div class="panel">
                <p>Pellentesque blandit arcu eu orci venenatis aliquet. Morbi in quam porta nibh hendrerit dapibus. Donec erat tortor, ullamcorper in
                    dictum a, rhoncus quis risus. Phasellus luctus commodo aliquam. Pellentesque ac orci nec ligula efficitur blandit vel at sem. Sed
                    commodo orci sapien, a finibus odio dignissim ac. Nunc ante purus, elementum ac tempor sed, facilisis sit amet ligula.</p>
                <p>Donec neque urna, imperdiet a nisl eget, finibus mollis lacus. Nunc efficitur a elit in facilisis. Maecenas massa ex, tempor ac viverra
                    id, varius et massa. Sed convallis, metus a aliquet suscipit, purus nunc ultrices est, sed dapibus tellus sapien eget libero. Praesent
                    maximus velit vitae est venenatis, nec lobortis arcu consectetur. Aenean vitae tincidunt mauris, pellentesque pulvinar ante. Proin
                    malesuada vestibulum justo lacinia finibus. Nulla nibh ante, iaculis sit amet pharetra at, tincidunt quis nisi.</p>
            </div>
            </div>

        </div>
    </div>
@endsection
@push('script')

    <script>
        // $(document).ready(function () {
        //     $("#myaccordion").accordion();
        // });

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>



@endpush
