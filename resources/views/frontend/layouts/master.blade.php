<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" lang="en-US"> <![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="en-US"> <![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="en-US">
<!--<![endif]-->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- /Added by HTTrack -->
<style>
    body{
        /*position: relative;*/
        /*display: block;*/

        /*height: 1000px;*/
        /*overflow-y: scroll;*/

    }

    #mNavbar{
        top: 0;
        background: #133696 !important;
        /*opacity: 0.6;*/
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="{{ asset('frontend/xmlrpc.html') }}">
    <link type="text/css" media="all"
          href="{{ asset('frontend/wp-content/cache/autoptimize/css/autoptimize_81c1e23f2250df8cdac518df65bb6823.css') }}"
          rel="stylesheet"/>
    <link type="text/css" media="only screen and (max-width: 768px)"
          href="{{ asset('frontend/wp-content/cache/autoptimize/css/autoptimize_dcb2de333eec7ab4ae31385ed8d6a393.css') }}"
          rel="stylesheet"/>
    <title>Cfresh &#8211; E-commerce</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/googleapis.css') }}"/>
    <link href="{{asset('frontend/css/bootstrap-iso.css')}}" rel="stylesheet">
    @stack('css')
    @include('frontend.includes.links')
    <link rel="stylesheet" href="{{asset('frontend/css/alert.css')}}">


</head>

<body class="page-template-default page page-id-3093 woocommerce-no-js tribe-no-js masthead-fixed full-width footer-widgets singular paceloader-default wpb-js-composer js-comp-ver-5.7 vc_responsive">
<div id="preloader"></div>

{{--NAVBAR GOES HERE--}}
@include('frontend.includes.navbar')

{{--HEADER GOES HERE--}}

@include('frontend.includes.header')

<div class="container">
    @yield('content')
</div>

@include('frontend.includes.footer')

<script>
    (function(body) {
        'use strict';
        body.className = body.className.replace(/\btribe-no-js\b/, 'tribe-js');
    })(document.body);
</script>
<script>
    var tribe_l10n_datatables = {
        "aria": {
            "sort_ascending": ": activate to sort column ascending",
            "sort_descending": ": activate to sort column descending"
        },
        "length_menu": "Show _MENU_ entries",
        "empty_table": "No data available in table",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "info_empty": "Showing 0 to 0 of 0 entries",
        "info_filtered": "(filtered from _MAX_ total entries)",
        "zero_records": "No matching records found",
        "search": "Search:",
        "all_selected_text": "All items on this page were selected. ",
        "select_all_link": "Select all pages",
        "clear_selection": "Clear Selection.",
        "pagination": {
            "all": "All",
            "next": "Next",
            "previous": "Previous"
        },
        "select": {
            "rows": {
                "0": "",
                "_": ": Selected %d rows",
                "1": ": Selected 1 row"
            }
        },
        "datepicker": {
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesMin": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Prev",
            "currentText": "Today",
            "closeText": "Done",
            "today": "Today",
            "clear": "Clear"
        }
    };
    var tribe_system_info = {
        "sysinfo_optin_nonce": "9d12e2e3de",
        "clipboard_btn_text": "Copy to clipboard",
        "clipboard_copied_text": "System info copied",
        "clipboard_fail_text": "Press \"Cmd + C\" to copy"
    };
</script>
<script>
    (function() {
        function addEventListener(element, event, handler) {
            if (element.addEventListener) {
                element.addEventListener(event, handler, false);
            } else if (element.attachEvent) {
                element.attachEvent('on' + event, handler);
            }
        }

        function maybePrefixUrlField() {
            if (this.value.trim() !== '' && this.value.indexOf('http') !== 0) {
                this.value = "http://" + this.value;
            }
        }

        var urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]');
        if (urlFields && urlFields.length > 0) {
            for (var j = 0; j < urlFields.length; j++) {
                addEventListener(urlFields[j], 'blur', maybePrefixUrlField);
            }
        } /* test if browser supports date fields */
        var testInput = document.createElement('input');
        testInput.setAttribute('type', 'date');
        if (testInput.type !== 'date') {

            /* add placeholder & pattern to all date fields */
            var dateFields = document.querySelectorAll('.mc4wp-form input[type="date"]');
            for (var i = 0; i < dateFields.length; i++) {
                if (!dateFields[i].placeholder) {
                    dateFields[i].placeholder = 'YYYY-MM-DD';
                }
                if (!dateFields[i].pattern) {
                    dateFields[i].pattern = '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])';
                }
            }
        }

    })();
</script>
<script type="text/javascript">
    var c = document.body.className;
    c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
    document.body.className = c;
</script>
<script type='text/javascript'>
    var wpcf7 = {
        "apiSettings": {
            "root": "http:\/\/aquaterias.like-themes.com\/wp-json\/contact-form-7\/v1",
            "namespace": "contact-form-7\/v1"
        },
        "cached": "1"
    };
</script>
<script type='text/javascript'>
    var woocommerce_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
    };
</script>
<script type='text/javascript'>
    var wc_cart_fragments_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "cart_hash_key": "wc_cart_hash_2aca1d16d68a674941fbe9190415a99e",
        "fragment_name": "wc_fragments_2aca1d16d68a674941fbe9190415a99e"
    };
</script>
<script type='text/javascript'>
    var mc4wp_forms_config = [];
</script>
<!--[if lte IE 9]> <script type='text/javascript' src="{{asset('frontend/wp-content/plugins/mailchimp-for-wp/assets/js/third-party/placeholders.min.js?ver=4.3.3')}}"></script> <![endif]-->
<script type="text/javascript" defer src="{{asset('frontend/wp-content/cache/autoptimize/js/autoptimize_e7ac1e4c0637f27b5320e669dbbb7a9c.js')}}"></script>

@yield('scripting')
<script>
    jQuery(function () {
        jQuery.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    jQuery(function () {
        var $navbar = jQuery("#mNavbar");

        AdjustHeader(); // Incase the user loads the page from halfway down (or something);
        jQuery(window).scroll(function() {
            AdjustHeader();
        });

        function AdjustHeader(){
            if (jQuery(window).scrollTop() > 80) {
                if (!$navbar.hasClass("navbar-fixed-top")) {
                    $navbar.addClass("navbar-fixed-top");
                }
            } else {
                $navbar.removeClass("navbar-fixed-top");
            }
        }
    });


</script>
@stack('script')
<script>


        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif

</script>



</body>
<!-- Mirrored from aquaterias.like-themes.com/about-us-aqua/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Jun 2020 21:56:03 GMT -->

</html>
<!-- Dynamic page generated in 0.824 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2020-06-19 21:49:54 -->

<!-- super cache -->
