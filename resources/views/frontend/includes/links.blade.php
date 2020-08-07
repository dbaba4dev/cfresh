{{--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
<link href="{{asset('frontend/css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
<link rel="alternate" type="application/rss+xml" title="C-fresh &raquo; Feed"
      href="{{ asset('frontend/feed/index.html') }}"/>
<link rel="alternate" type="application/rss+xml" title="C-fresh &raquo; Comments Feed"
      href="{{ asset('frontend/comments/feed/index.html') }}"/>
<link rel="alternate" type="text/calendar" title="C-fresh &raquo; iCal Feed"
      href="{{ asset('frontend/events/indexedf3.html?ical=1') }}"/>


<script type="text/javascript">
    window._wpemojiSettings = {
        "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11.2.0\/72x72\/",
        "ext": ".png",
        "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11.2.0\/svg\/",
        "svgExt": ".svg",
        "source": {
            "concatemoji": "http:\/\/aquaterias.like-themes.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.1.6"
        }
    };
    ! function(a, b, c) {
        function d(a, b) {
            var c = String.fromCharCode;
            l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
            var d = k.toDataURL();
            l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
            var e = k.toDataURL();
            return d === e
        }

        function e(a) {
            var b;
            if (!l || !l.fillText) return !1;
            switch (l.textBaseline = "top", l.font = "600 32px Arial", a) {
                case "flag":
                    return !(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]), !b);
                case "emoji":
                    return b = d([55358, 56760, 9792, 65039], [55358, 56760, 8203, 9792, 65039]), !b
            }
            return !1
        }

        function f(a) {
            var c = b.createElement("script");
            c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
        }
        var g, h, i, j, k = b.createElement("canvas"),
            l = k.getContext && k.getContext("2d");
        for (j = Array("flag", "emoji"), c.supports = {
            everything: !0,
            everythingExceptFlag: !0
        }, i = 0; i < j.length; i++) c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c.supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[j[i]]);
        c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function() {
            c.DOMReady = !0
        }, c.supports.everything || (h = function() {
            c.readyCallback()
        }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function() {
            "complete" === b.readyState && c.readyCallback()
        })), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g.wpemoji)))
    }(window, document, window._wpemojiSettings);
</script>
<link rel='stylesheet' id='dashicons-css'
      href="{{ asset('frontend/wp-includes/css/dashicons.minb62d.css?ver=5.1.6') }}"
      type='text/css' media='all'/>
<style id='aquaterias-theme-style-inline-css' type='text/css'>
    .heading.bg-image {
        background-image: url(frontend/wp-content/uploads/2017/12/heading-bg.png) !important;
    }

    .page-header {
        background-image: url(frontend/wp-content/uploads/2018/01/inner_slide_40percent.jpg) !important;
    }

    .go-top:before {
        background-image: url(frontend/wp-content/uploads/2017/12/go-top.png) !important;
    }

    nav.navbar .logo img {
        max-height: 80px !important;
    }

    .widget .search-form a,
    .page-content .search-form a,
    a,
    a.black:hover,
    a.black:focus,
    footer a,
    .blog-info .fa,
    header.page-header .breadcrumbs li,
    header.page-header .breadcrumbs li a:hover,
    header.page-header h1,
    .woocommerce ul.products li.product .woocommerce-loop-category__title:hover,
    .woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
    .woocommerce ul.products li.product h3:hover,
    .products-sc .header:hover,
    .color-main,
    div.top-bar.container .cart:hover,
    div.top-bar.container .cart:focus,
    .comments-area .comment-info .comment-author,
    .comments-area .comment-reply-link:hover,
    .comments-area .comment-reply-link:before,
    .heading.spanned h4,
    .heading.color-main .header,
    .heading.subcolor-main .subheader,
    .multi-doc .block-right .descr,
    .tariff-item .header,
    #block-footer h4,
    #block-footer .social-icons-list a:hover,
    #block-footer .address li span,
    #block-footer .address li a:hover,
    #block-footer .widget_nav_menu ul li.active a,
    #block-footer .widget_nav_menu ul li a:before,
    .widget_calendar caption,
    body.body-black-dark .blog article .description .header,
    .blog-sc article .blog-info .cat,
    .blog-post .cats-short,
    .events-list .date .date-day,
    .gallery-page .descr .fa,
    .woocommerce #payment #place_order.btn-second:hover,
    .woocommerce-page #payment #place_order.btn-second:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-second:hover,
    .woocommerce div.product form.cart .button.btn-second:hover,
    .woocommerce #respond input#submit.btn-second:hover,
    .woocommerce a.button.btn-second:hover,
    .woocommerce button.button.btn-second:hover,
    .woocommerce input.button.btn-second:hover,
    .button.btn-second:hover,
    input[type="submit"].btn-second:hover,
    .wpcf7-submit.btn-second:hover,
    .btn.btn-second:hover,
    .woocommerce-product-search input[type="submit"].btn-second:hover,
    .wp-searchform input[type="submit"].btn-second:hover,
    form.post-password-form input[type="submit"].btn-second:hover,
    form.search-form input[type="submit"].btn-second:hover,
    form.wpcf7-form input[type="submit"].btn-second:hover,
    form.form input[type="submit"].btn-second:hover,
    form.comment-form input[type="submit"].btn-second:hover,
    form input[type="submit"].btn-second:hover,
    .woocommerce #payment #place_order.btn-default-bordered,
    .woocommerce-page #payment #place_order.btn-default-bordered,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-default-bordered,
    .woocommerce div.product form.cart .button.btn-default-bordered,
    .woocommerce #respond input#submit.btn-default-bordered,
    .woocommerce a.button.btn-default-bordered,
    .woocommerce button.button.btn-default-bordered,
    .woocommerce input.button.btn-default-bordered,
    .button.btn-default-bordered,
    input[type="submit"].btn-default-bordered,
    .wpcf7-submit.btn-default-bordered,
    .btn.btn-default-bordered,
    .woocommerce-product-search input[type="submit"].btn-default-bordered,
    .wp-searchform input[type="submit"].btn-default-bordered,
    form.post-password-form input[type="submit"].btn-default-bordered,
    form.search-form input[type="submit"].btn-default-bordered,
    form.wpcf7-form input[type="submit"].btn-default-bordered,
    form.form input[type="submit"].btn-default-bordered,
    form.comment-form input[type="submit"].btn-default-bordered,
    form input[type="submit"].btn-default-bordered,
    .block-descr h4,
    .wpb-js-composer .vc_tta-panel .vc_tta-icon,
    .block-icon.layout-cols6 li h5,
    .block-icon.icon-h-right span,
    .block-icon.layout-inline.i-transparent a,
    .block-icon.layout-inline.i-transparent span,
    .tags a,
    .tags a:hover,
    .team-item h4,
    .products-sc article .price.color-main,
    .services-sc .arrow-left,
    .services-sc .arrow-right,
    .zs-enabled .zs-arrows .arrow-right:hover,
    .zs-enabled .zs-arrows .arrow-left:hover,
    .zs-enabled .zs-arrows .arrow-right:hover:before,
    .zs-enabled .zs-arrows .arrow-left:hover:before,
    .zs-enabled .zs-arrows .arrow-right:hover:after,
    .zs-enabled .zs-arrows .arrow-left:hover:after,
    .woocommerce .product_meta>span span,
    .woocommerce div.product .woocommerce-product-rating,
    .woocommerce .star-rating span,
    .woocommerce-MyAccount-navigation ul li:before,
    .woocommerce-MyAccount-navigation ul li a:hover,
    .woocommerce-message::before,
    nav.navbar #navbar ul.navbar-nav ul.children li.current_page_item>a,
    nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current_page_item>a,
    nav.navbar #navbar ul.navbar-nav .current_page_parent>a,
    nav.navbar #navbar ul.navbar-nav .current_page_item>a,
    nav.navbar #navbar ul.navbar-nav>li.hasSub:hover>a,
    nav.navbar #navbar ul.navbar-nav a:hover,
    nav.navbar #navbar ul.navbar-nav ul,
    nav.navbar #navbar ul.navbar-nav>li.page_item_has_children:hover>ul,
    ul.navbar-nav>li.current-menu-ancestor>a,
    nav.navbar #navbar ul.navbar-nav>li.current-menu-item>a,
    nav.navbar #navbar ul.navbar-nav>li.current-menu-parent>a,
    nav.navbar #navbar ul.navbar-nav>li.current_page_parent>a,
    nav.navbar #navbar ul.navbar-nav>li.current_page_item>a,
    .social-icons-list li span.fa,
    .woocommerce.widget_shopping_cart .quantity .amount,
    .woocommerce .widget_shopping_cart .quantity .amount,
    .woocommerce div.product p.price,
    .woocommerce div.product span.price,
    .woocommerce ul.products li.product .price,
    .woocommerce table.shop_table .woocommerce-cart-form__cart-item .product-subtotal,
    .woocommerce table.shop_table .woocommerce-cart-form__cart-item .product-price,
    .widget-area aside ul li:before,
    .widget-area aside ul li a:hover {
        color: #21b6ff;
    }

    @media (min-width: 1199px) {
        nav.navbar.navbar-default #navbar ul.navbar-nav>li:not(.current-menu-parent):not(.current-menu-ancestor)>a:hover,
        nav.navbar #navbar ul.navbar-nav>li.current-menu-ancestor>a,
        nav.navbar #navbar ul.navbar-nav>li.current-menu-item>a,
        nav.navbar #navbar ul.navbar-nav>li.current-menu-parent>a,
        nav.navbar #navbar ul.navbar-nav>li.current_page_parent>a,
        nav.navbar #navbar ul.navbar-nav>li.current_page_item>a,
        nav.navbar #navbar ul.navbar-nav a:hover,
        nav.navbar #navbar ul.navbar-nav>li.page_item_has_children>a:hover:after,
        nav.navbar #navbar ul.navbar-nav>li.menu-item-has-children>a:hover:after,
        nav.navbar #navbar ul.navbar-nav>li.hasSub>a:hover:after,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-item>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu:not(.mega-menu-row) li.current-menu-item>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-parent>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu:not(.mega-menu-row) li.current-menu-parent>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_parent>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu:not(.mega-menu-row) li.current_page_parent>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_item>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu:not(.mega-menu-row) li.current_page_item>a {
            color: #21b6ff;
        }
    }

    @media (min-width: 991px) {
        nav.navbar.navbar-default #navbar ul.navbar-nav>li>a:hover,
        nav.navbar.navbar-default #navbar ul.navbar-nav>li.page_item_has_children>a:hover:after,
        nav.navbar.navbar-default #navbar ul.navbar-nav>li.menu-item-has-children>a:hover:after,
        nav.navbar.navbar-default #navbar ul.navbar-nav>li.hasSub>a:hover:after {
            color: #21b6ff;
        }
    }

    #block-footer .widget_nav_menu ul li.current_page_parent a,
    #block-footer .widget_nav_menu ul li.current_page_item a,
    #block-footer .widget_nav_menu ul li.current_menu_item a,
    #block-footer a:hover:not(.btn):not(.fa),
    .woocommerce ul.products li.product a:hover,
    .blog a.header:hover,
    .blog article .description .header:hover,
    .vc_tta-accordion h4 a,
    #block-footer .social-icons-list .fa,
    .vc_message_box.vc_color-info,
    .alert.vc_color-info,
    .vc_message_box.vc_color-info .fa,
    .alert.vc_color-info .fa {
        color: #21b6ff !important;
    }

    .ltx-topbar-block,
    nav.navbar .nav-right .cart,
    nav.navbar #navbar ul.navbar-nav ul.children li a::after,
    nav.navbar #navbar ul.navbar-nav ul.sub-menu li a::after,
    .top-search,
    .image-video span.play,
    .woocommerce span.onsale,
    .woocommerce div.product .woocommerce-tabs ul.tabs li,
    .widget_calendar #today::before,
    .paceloader-dots .dot::before,
    .testimonials-list .arrow-left,
    .testimonials-list .arrow-right,
    .swiper-pagination .swiper-pagination-bullet-active:after,
    .zs-enabled .zs-arrows .arrow-right:hover:before,
    .zs-enabled .zs-arrows .arrow-left:hover:before,
    .zs-enabled .zs-arrows .arrow-right:hover:after,
    .zs-enabled .zs-arrows .arrow-left:hover:after,
    .header-rounded>*,
    .comment-text table thead th,
    .text-page table thead th,
    footer .go-top,
    .woocommerce #payment #place_order,
    .woocommerce-page #payment #place_order,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
    .woocommerce div.product form.cart .button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .button,
    input[type="submit"],
    .wpcf7-submit,
    .btn,
    .woocommerce-product-search input[type="submit"],
    .wp-searchform input[type="submit"],
    form.post-password-form input[type="submit"],
    form.search-form input[type="submit"],
    form.wpcf7-form input[type="submit"],
    form.form input[type="submit"],
    form.comment-form input[type="submit"],
    form input[type="submit"],
    .woocommerce #payment #place_order.btn-main-filled,
    .woocommerce-page #payment #place_order.btn-main-filled,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-main-filled,
    .woocommerce div.product form.cart .button.btn-main-filled,
    .woocommerce #respond input#submit.btn-main-filled,
    .woocommerce a.button.btn-main-filled,
    .woocommerce button.button.btn-main-filled,
    .woocommerce input.button.btn-main-filled,
    .button.btn-main-filled,
    input[type="submit"].btn-main-filled,
    .wpcf7-submit.btn-main-filled,
    .btn.btn-main-filled,
    .woocommerce-product-search input[type="submit"].btn-main-filled,
    .wp-searchform input[type="submit"].btn-main-filled,
    form.post-password-form input[type="submit"].btn-main-filled,
    form.search-form input[type="submit"].btn-main-filled,
    form.wpcf7-form input[type="submit"].btn-main-filled,
    form.form input[type="submit"].btn-main-filled,
    form.comment-form input[type="submit"].btn-main-filled,
    form input[type="submit"].btn-main-filled,
    .woocommerce #payment #place_order.btn-gray-filled:hover,
    .woocommerce-page #payment #place_order.btn-gray-filled:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-gray-filled:hover,
    .woocommerce div.product form.cart .button.btn-gray-filled:hover,
    .woocommerce #respond input#submit.btn-gray-filled:hover,
    .woocommerce a.button.btn-gray-filled:hover,
    .woocommerce button.button.btn-gray-filled:hover,
    .woocommerce input.button.btn-gray-filled:hover,
    .button.btn-gray-filled:hover,
    input[type="submit"].btn-gray-filled:hover,
    .wpcf7-submit.btn-gray-filled:hover,
    .btn.btn-gray-filled:hover,
    .woocommerce-product-search input[type="submit"].btn-gray-filled:hover,
    .wp-searchform input[type="submit"].btn-gray-filled:hover,
    form.post-password-form input[type="submit"].btn-gray-filled:hover,
    form.search-form input[type="submit"].btn-gray-filled:hover,
    form.wpcf7-form input[type="submit"].btn-gray-filled:hover,
    form.form input[type="submit"].btn-gray-filled:hover,
    form.comment-form input[type="submit"].btn-gray-filled:hover,
    form input[type="submit"].btn-gray-filled:hover,
    .woocommerce #payment #place_order.color-hover-main:hover,
    .woocommerce-page #payment #place_order.color-hover-main:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-hover-main:hover,
    .woocommerce div.product form.cart .button.color-hover-main:hover,
    .woocommerce #respond input#submit.color-hover-main:hover,
    .woocommerce a.button.color-hover-main:hover,
    .woocommerce button.button.color-hover-main:hover,
    .woocommerce input.button.color-hover-main:hover,
    .button.color-hover-main:hover,
    input[type="submit"].color-hover-main:hover,
    .wpcf7-submit.color-hover-main:hover,
    .btn.color-hover-main:hover,
    .woocommerce-product-search input[type="submit"].color-hover-main:hover,
    .wp-searchform input[type="submit"].color-hover-main:hover,
    form.post-password-form input[type="submit"].color-hover-main:hover,
    form.search-form input[type="submit"].color-hover-main:hover,
    form.wpcf7-form input[type="submit"].color-hover-main:hover,
    form.form input[type="submit"].color-hover-main:hover,
    form.comment-form input[type="submit"].color-hover-main:hover,
    form input[type="submit"].color-hover-main:hover,
    .swiper-pagination .swiper-pagination-bullet-active,
    .alert.alert-important,
    .social-icons-list.icon-style-round span.fa,
    .block-icon.icon-ht-left a,
    .block-icon.icon-ht-left span,
    .block-icon.icon-ht-right span,
    .block-icon.icon-top a,
    .block-icon.icon-top span,
    .block-icon li .bg-main,
    .zs-enabled .zs-slideshow .zs-bullets .zs-bullet,
    .menu-sc .header,
    .menu-sc .price,
    .bg-color-theme_color.vc_row-fluid,
    .bg-color-theme_color.vc_section,
    .bg-color-theme_color.vc_column_container .vc_column-inner,
    .progressBar .bar div,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab>a {
        background-color: #21b6ff;
    }

    .wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab:not(.vc_active)>a,
    .bg-color-black .btn-white-filled:hover,
    .woocommerce .swiper-container .arrow-left:hover,
    .woocommerce .swiper-container .arrow-right:hover,
    .btn.btn-active,
    .vc_progress_bar .vc_single_bar .vc_bar,
    .vc_message_box.vc_color-warning,
    alert.vc_color-warning {
        background-color: #21b6ff !important;
    }

    @media (max-width: 1199px) {
        nav.navbar #navbar {
            background-color: #21b6ff;
        }
    }

    .bg-color-gradient {
        background: linear-gradient(to right, rgba(0, 44, 143, 1) 0%, rgba(33, 182, 255, 1) 100%) !important;
    }

    .woocommerce #payment #place_order,
    .woocommerce-page #payment #place_order,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
    .woocommerce div.product form.cart .button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .button,
    input[type="submit"],
    .wpcf7-submit,
    .btn,
    .woocommerce-product-search input[type="submit"],
    .wp-searchform input[type="submit"],
    form.post-password-form input[type="submit"],
    form.search-form input[type="submit"],
    form.wpcf7-form input[type="submit"],
    form.form input[type="submit"],
    form.comment-form input[type="submit"],
    form input[type="submit"] {
        -webkit-box-shadow: 0 10px 30px rgba(33, 182, 255, 0.3);
        -moz-box-shadow: 0 10px 30px rgba(33, 182, 255, 0.3);
        box-shadow: 0 10px 30px rgba(33, 182, 255, 0.3);
    }

    .wpb_single_image .vc_single_image-wrapper.vc_box_shadow img {
        -webkit-box-shadow: 20px 20px 0 #21b6ff !important;
        -moz-box-shadow: 20px 20px 0 #21b6ff !important;
        box-shadow: 20px 20px 0 #21b6ff !important;
    }

    .vc_tta-tabs.vc_tta-style-flat .vc_tta-tabs-list .vc_active a span,
    .countUp-item,
    .tabs-cats li span.cat-active,
    .swiper-pagination .swiper-pagination-bullet-active::after,
    .sticky,
    .footer-widget-area .null-instagram-feed .instagram-pics a img:hover,
    .woocommerce #payment #place_order.btn-default-bordered,
    .woocommerce-page #payment #place_order.btn-default-bordered,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-default-bordered,
    .woocommerce div.product form.cart .button.btn-default-bordered,
    .woocommerce #respond input#submit.btn-default-bordered,
    .woocommerce a.button.btn-default-bordered,
    .woocommerce button.button.btn-default-bordered,
    .woocommerce input.button.btn-default-bordered,
    .button.btn-default-bordered,
    .nput[type="submit"].btn-default-bordered,
    .wpcf7-submit.btn-default-bordered,
    .btn.btn-default-bordered,
    .woocommerce-product-search input[type="submit"].btn-default-bordered,
    .wp-searchform input[type="submit"].btn-default-bordered,
    form.post-password-form input[type="submit"].btn-default-bordered,
    form.search-form input[type="submit"].btn-default-bordered,
    form.wpcf7-form input[type="submit"].btn-default-bordered,
    form.form input[type="submit"].btn-default-bordered,
    form.comment-form input[type="submit"].btn-default-bordered,
    form input[type="submit"].btn-default-bordered,
    .tags a,
    .tags a:hover.tariff-item.vip,
    .testimonials-list .inner {
        border-color: #21b6ff;
    }

    nav.navbar.navbar-default-light #navbar ul.navbar-nav>li:not(.current-menu-parent):not(.current-menu-ancestor)>a:hover,
    nav.navbar.navbar-default-light #navbar ul.navbar-nav>li.current-menu-parent>a,
    nav.navbar.navbar-default-light #navbar ul.navbar-nav>li.current-menu-ancestor>a,
    .woocommerce form .form-row .required,
    .woocommerce ul.products li.product .price ins,
    .btn.btn-add-bordered,
    .tariff-slider-sc .ul-yes,
    .color-second,
    .tariff-item.vip .price,
    .top-bar .cart:hover,
    .top-bar .cart .fa:hover,
    .products-sc.products-sc-fastfood article:hover .header h5,
    .heading.color-second h1,
    .heading.color-second h2,
    .heading.color-second h3,
    .heading.color-second h4,
    .heading.color-second h5,
    .heading.color-second h6,
    .blog-sc.layout-date-top article .header>*:hover,
    .products-sc.products-sc-fastfood .price.color-second,
    .heading.subcolor-second .subheader,
    .blog-sc article .blog-info .cat-div,
    .blog-sc article .blog-info .date.date-bold {
        color: #AEC556;
    }

    .image-video span.play:hover,
    .social-big li a:hover,
    nav.navbar .cart .count,
    nav.navbar .nav-right .cart .count,
    .bg-color-second.vc_row-fluid,
    .bg-color-second.vc_section,
    .bg-color-second.vc_column_container .vc_column-inner,
    .top-bar .cart .count,
    .navbar .cart .count,
    .woocommerce span.wc-label-new,
    .bg-color-second.vc_section,
    .bg-color-second.vc_column_container .vc_column-inner,
    .btn.color-hover-second:hover,
    .cart .count,
    .btn.btn-second,
    .btn.btn-add,
    .bg-color-second.vc_section,
    .bg-color-second.vc_column_container .vc_column-inner,
    .like-contact-form-7.form-style-secondary form input[type="submit"] {
        background-color: #AEC556;
    }

    .btn.btn-add-bordered {
        border-color: #AEC556;
    }

    .heading .icon-bg,
    .testimonials-list .inner .fa,
    .testimonials-list.inner-page .inner .fa,
    #block-footer .address li a,
    .woocommerce-MyAccount-navigation aside .wp-searchform button[type="submit"],
    .gallery-page .descr a,
    .gallery-page ul li,
    .wpcf7-form-control-wrap.to:after,
    .wpcf7-form-control-wrap.phone:after,
    .wpcf7-form-control-wrap.date:after,
    .wpcf7-form-control-wrap.cartype:after,
    .wpcf7-form-control-wrap.address:after,
    .block-descr .date,
    .woocommerce-info::before {
        color: #F1F6FB;
    }

    aside,
    .bg-color-gray.vc_column_container>.vc_column-inner,
    .bg-color-gray.vc_row-fluid,
    .bg-color-gray.vc_section,
    .top-search input[type='text'],
    .comments-area .comment-list li .comment-single,
    .comment-text table tbody th,
    .text-page table tbody th,
    .testimonials-block,
    .testimonials,
    .events-list .date,
    .woocommerce-product-search,
    .wp-searchform,
    form.post-password-form,
    form.search-form,
    form.wpcf7-form,
    form.form,
    form.comment-form,
    form,
    .woocommerce #payment #place_order.btn-gray-filled,
    .woocommerce-page #payment #place_order.btn-gray-filled,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-gray-filled,
    .woocommerce div.product form.cart .button.btn-gray-filled,
    .woocommerce #respond input#submit.btn-gray-filled,
    .woocommerce a.button.btn-gray-filled,
    .woocommerce button.button.btn-gray-filled,
    .woocommerce input.button.btn-gray-filled,
    .button.btn-gray-filled,
    input[type="submit"].btn-gray-filled,
    .wpcf7-submit.btn-gray-filled,
    .btn.btn-gray-filled,
    .woocommerce-product-search input[type="submit"].btn-gray-filled,
    .wp-searchform input[type="submit"].btn-gray-filled,
    form.post-password-form input[type="submit"].btn-gray-filled,
    form.search-form input[type="submit"].btn-gray-filled,
    form.wpcf7-form input[type="submit"].btn-gray-filled,
    form.form input[type="submit"].btn-gray-filled,
    form.comment-form input[type="submit"].btn-gray-filled,
    form input[type="submit"].btn-gray-filled,
    .like-contact-form-7.form-bg-default,
    .block-icon li .bg-gray,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .woocommerce div.product .woocommerce-tabs .panel,
    .woocommerce div.quantity span,
    .woocommerce div.product form.cart div.quantity span,
    .woocommerce-page div.product form.cart div.quantity span,
    .woocommerce-MyAccount-navigation {
        background-color: #F1F6FB;
    }

    @media (min-width: 768px) {
        .woocommerce table.shop_table .woocommerce-cart-form__cart-item:nth-child(even) td {
            background-color: #F1F6FB;
        }
    }

    .vc_separator.vc_sep_color_grey .vc_sep_line {
        border-color: #F1F6FB !important;
    }

    .woocommerce-cart .cart-collaterals .cart_totals tr th,
    .woocommerce table.shop_table tbody:first-child tr:first-child td,
    .woocommerce table.shop_table tbody:first-child tr:first-child th,
    nav.navbar.navbar-default-light #navbar ul.navbar-nav>li:not(.current-menu-parent):not(.current-menu-ancestor)>a,
    .woocommerce a.button.color-text-white:hover,
    .btn.color-text-white:hover,
    .woocommerce button.button.btn-black-filled:hover,
    .woocommerce button.button:hover,
    .blog article .header:hover h3,
    .black,
    body,
    .tags a:hover,
    .select2-container--default .select2-selection--single .select2-selection__arrow:before,
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .comments-area .comments-title,
    .comments-area .comment-reply-link,
    .comments-form-wrap h3,
    .comments-form-wrap h3.comment-reply-title,
    .bg-color-white,
    ul.ul-arrow li,
    ul.arrow li,
    ul.disc li,
    ul.check li,
    .ul-no,
    .heading.color-black .header,
    .heading.color-gray .header,
    .heading.subcolor-black .subheader,
    .heading.text-bg .header-text,
    .tariffs-block,
    .tariffs-block h2,
    .tariff-item,
    .tariff-item .price,
    .null-instagram-feed a,
    .blog-info .date-my,
    .blog-info ul,
    .blog-post .tags-short strong,
    .blog-post .cats-short strong,
    .events-list .date .date-my,
    .btn-default-bordered:hover,
    input[type="submit"]:hover,
    .btn.btn-default:hover,
    .btn.btn-black-filled:hover,
    .btn-white-bordered:hover,
    .btn.btn-second-bordered,
    .btn-second-bordered,
    .btn.btn-black:hover,
    .btn-black:hover,
    .btn-white-filled,
    .btn.btn-white-filled,
    .btn-gray-filled,
    .btn.btn-gray-filled,
    .btn-main-filled,
    .btn.btn-main-filled,
    .button,
    textarea,
    input,
    .menu-types a,
    .alert.alert-success p,
    .alert .close,
    .vc_tta-accordion h4:hover,
    .vc_tta-accordion .vc_tta-panel-body,
    .vc_tta-accordion .vc_tta-panel-body .wpb_content_element,
    .social-icons-list li a,
    .social-icons-list.icon-style-round span.fa:before,
    .social-small li a,
    .team-item ul li a,
    .tabs-cats.menu-filter li span,
    .products-sc,
    .products-sc article .header,
    .products-sc article .price del,
    .bg-color-black .products-sc article,
    .slider-zoom.zoom-color-black,
    .menu-sc .items,
    .woocommerce nav.woocommerce-pagination ul .page-numbers:not(.next):not(.prev),
    .woocommerce nav.woocommerce-pagination ul .prev:hover:after,
    .woocommerce nav.woocommerce-pagination ul .next:hover:after,
    .woocommerce nav.woocommerce-pagination ul .prev.disabled,
    .woocommerce nav.woocommerce-pagination ul .next.disabled,
    .woocommerce nav.woocommerce-pagination ul .prev:before,
    .woocommerce nav.woocommerce-pagination ul .next:after,
    a:focus,
    a:hover,
    .woocommerce div.product del,
    .woocommerce .variations td.label,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .woocommerce-page div.product form.cart div.quantity span,
    .woocommerce table.shop_table .woocommerce-cart-form__cart-item .product-name a,
    .woocommerce input[name="update_cart"],
    .woocommerce-MyAccount-navigation ul li,
    .woocommerce-MyAccount-navigation ul li a,
    .woocommerce-MyAccount-navigation ul li.current-cat a,
    .woocommerce ul.products li.product .woocommerce-loop-category__title,
    .woocommerce ul.products li.product .woocommerce-loop-product__title,
    .woocommerce ul.products li.product h2,
    .widget-area aside ul li a,
    .widget_calendar th,
    .widget_calendar td {
        color: #0080ff;
    }

    .bg-color-black .btn.btn-white-filled:hover,
    .btn.color-hover-white:hover,
    .vc_message_box.vc_color-warning .fa,
    .vc_message_box.vc_color-warning,
    .alert.vc_color-warning,
    .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab span {
        color: #0080ff !important;
    }

    @media (min-width: 1199px) {
        nav.navbar #navbar ul.navbar-nav a {
            color: #0080ff;
        }
    }

    @media (max-width: 1199px) {
        nav.navbar #navbar .cart-mob,
        nav.navbar ul.navbar-nav>li>a,
        nav.navbar ul.navbar-nav li.menu-item-has-children>a:after,
        nav.navbar ul.navbar-nav ul li a {
            color: #0080ff;
        }
    }

    .products-sc .arrow-left,
    .products-sc .arrow-right,
    body.body-black-dark,
    header.page-header,
    nav.navbar .navbar-toggle .icon-bar,
    .tariff-item.vip,
    footer,
    .gallery-page .photo:after,
    .woocommerce #payment #place_order:hover,
    .woocommerce-page #payment #place_order:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
    .woocommerce div.product form.cart .button:hover,
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce button.button:hover,
    .woocommerce input.button:hover,
    .button:hover,
    input[type="submit"]:hover,
    .wpcf7-submit:hover,
    .btn:hover,
    .woocommerce-product-search input[type="submit"]:hover,
    .wp-searchform input[type="submit"]:hover,
    form.post-password-form input[type="submit"]:hover,
    form.search-form input[type="submit"]:hover,
    form.wpcf7-form input[type="submit"]:hover,
    form.form input[type="submit"]:hover,
    form.comment-form input[type="submit"]:hover,
    form input[type="submit"]:hover,
    .woocommerce #payment #place_order.btn-white-filled:hover,
    .woocommerce-page #payment #place_order.btn-white-filled:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-filled:hover,
    .woocommerce div.product form.cart .button.btn-white-filled:hover,
    .woocommerce #respond input#submit.btn-white-filled:hover,
    .woocommerce a.button.btn-white-filled:hover,
    .woocommerce button.button.btn-white-filled:hover,
    .woocommerce input.button.btn-white-filled:hover,
    .button.btn-white-filled:hover,
    input[type="submit"].btn-white-filled:hover,
    .wpcf7-submit.btn-white-filled:hover,
    .btn.btn-white-filled:hover,
    .woocommerce-product-search input[type="submit"].btn-white-filled:hover,
    .wp-searchform input[type="submit"].btn-white-filled:hover,
    form.post-password-form input[type="submit"].btn-white-filled:hover,
    form.search-form input[type="submit"].btn-white-filled:hover,
    form.wpcf7-form input[type="submit"].btn-white-filled:hover,
    form.form input[type="submit"].btn-white-filled:hover,
    form.comment-form input[type="submit"].btn-white-filled:hover,
    form input[type="submit"].btn-white-filled:hover,
    .woocommerce #payment #place_order.btn-black-filled,
    .woocommerce-page #payment #place_order.btn-black-filled,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black-filled,
    .woocommerce div.product form.cart .button.btn-black-filled,
    .woocommerce #respond input#submit.btn-black-filled,
    .woocommerce a.button.btn-black-filled,
    .woocommerce button.button.btn-black-filled,
    .woocommerce input.button.btn-black-filled,
    .button.btn-black-filled,
    input[type="submit"].btn-black-filled,
    .wpcf7-submit.btn-black-filled,
    .btn.btn-black-filled,
    .woocommerce-product-search input[type="submit"].btn-black-filled,
    .wp-searchform input[type="submit"].btn-black-filled,
    form.post-password-form input[type="submit"].btn-black-filled,
    form.search-form input[type="submit"].btn-black-filled,
    form.wpcf7-form input[type="submit"].btn-black-filled,
    form.form input[type="submit"].btn-black-filled,
    form.comment-form input[type="submit"].btn-black-filled,
    form input[type="submit"].btn-black-filled,
    .woocommerce #payment #place_order.btn-black,
    .woocommerce-page #payment #place_order.btn-black,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black,
    .woocommerce div.product form.cart .button.btn-black,
    .woocommerce #respond input#submit.btn-black,
    .woocommerce a.button.btn-black,
    .woocommerce button.button.btn-black,
    .woocommerce input.button.btn-black,
    .button.btn-black,
    input[type="submit"].btn-black,
    .wpcf7-submit.btn-black,
    .btn.btn-black,
    .woocommerce-product-search input[type="submit"].btn-black,
    .wp-searchform input[type="submit"].btn-black,
    form.post-password-form input[type="submit"].btn-black,
    form.search-form input[type="submit"].btn-black,
    form.wpcf7-form input[type="submit"].btn-black,
    form.form input[type="submit"].btn-black,
    form.comment-form input[type="submit"].btn-black,
    form input[type="submit"].btn-black,
    .woocommerce #payment #place_order.btn-second-bordered:hover,
    .woocommerce-page #payment #place_order.btn-second-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-second-bordered:hover,
    .woocommerce div.product form.cart .button.btn-second-bordered:hover,
    .woocommerce #respond input#submit.btn-second-bordered:hover,
    .woocommerce a.button.btn-second-bordered:hover,
    .woocommerce button.button.btn-second-bordered:hover,
    .woocommerce input.button.btn-second-bordered:hover,
    .button.btn-second-bordered:hover,
    input[type="submit"].btn-second-bordered:hover,
    .wpcf7-submit.btn-second-bordered:hover,
    .btn.btn-second-bordered:hover,
    .woocommerce #payment #place_order.btn-black-bordered:hover,
    .woocommerce-page #payment #place_order.btn-black-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black-bordered:hover,
    .woocommerce div.product form.cart .button.btn-black-bordered:hover,
    .woocommerce #respond input#submit.btn-black-bordered:hover,
    .woocommerce a.button.btn-black-bordered:hover,
    .woocommerce button.button.btn-black-bordered:hover,
    .woocommerce input.button.btn-black-bordered:hover,
    .button.btn-black-bordered:hover,
    input[type="submit"].btn-black-bordered:hover,
    .wpcf7-submit.btn-black-bordered:hover,
    .btn.btn-black-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-second-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-black-bordered:hover,
    .wp-searchform input[type="submit"].btn-second-bordered:hover,
    .wp-searchform input[type="submit"].btn-black-bordered:hover,
    form.post-password-form input[type="submit"].btn-second-bordered:hover,
    form.post-password-form input[type="submit"].btn-black-bordered:hover,
    form.search-form input[type="submit"].btn-second-bordered:hover,
    form.search-form input[type="submit"].btn-black-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-second-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-black-bordered:hover,
    form.form input[type="submit"].btn-second-bordered:hover,
    form.form input[type="submit"].btn-black-bordered:hover,
    form.comment-form input[type="submit"].btn-second-bordered:hover,
    form.comment-form input[type="submit"].btn-black-bordered:hover,
    form input[type="submit"].btn-second-bordered:hover,
    form input[type="submit"].btn-black-bordered:hover,
    .woocommerce #payment #place_order.btn-add:hover,
    .woocommerce-page #payment #place_order.btn-add:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-add:hover,
    .woocommerce div.product form.cart .button.btn-add:hover,
    .woocommerce #respond input#submit.btn-add:hover,
    .woocommerce a.button.btn-add:hover,
    .woocommerce button.button.btn-add:hover,
    .woocommerce input.button.btn-add:hover,
    .button.btn-add:hover,
    input[type="submit"].btn-add:hover,
    .wpcf7-submit.btn-add:hover,
    .btn.btn-add:hover,
    .woocommerce-product-search input[type="submit"].btn-add:hover,
    .wp-searchform input[type="submit"].btn-add:hover,
    form.post-password-form input[type="submit"].btn-add:hover,
    form.search-form input[type="submit"].btn-add:hover,
    form.wpcf7-form input[type="submit"].btn-add:hover,
    form.form input[type="submit"].btn-add:hover,
    form.comment-form input[type="submit"].btn-add:hover,
    form input[type="submit"].btn-add:hover,
    .woocommerce #payment #place_order.color-hover-black:hover,
    .woocommerce-page #payment #place_order.color-hover-black:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-hover-black:hover,
    .woocommerce div.product form.cart .button.color-hover-black:hover,
    .woocommerce #respond input#submit.color-hover-black:hover,
    .woocommerce a.button.color-hover-black:hover,
    .woocommerce button.button.color-hover-black:hover,
    .woocommerce input.button.color-hover-black:hover,
    .button.color-hover-black:hover,
    input[type="submit"].color-hover-black:hover,
    .wpcf7-submit.color-hover-black:hover,
    .btn.color-hover-black:hover,
    .woocommerce-product-search input[type="submit"].color-hover-black:hover,
    .wp-searchform input[type="submit"].color-hover-black:hover,
    form.post-password-form input[type="submit"].color-hover-black:hover,
    form.search-form input[type="submit"].color-hover-black:hover,
    form.wpcf7-form input[type="submit"].color-hover-black:hover,
    form.form input[type="submit"].color-hover-black:hover,
    form.comment-form input[type="submit"].color-hover-black:hover,
    form input[type="submit"].color-hover-black:hover,
    label.css-radio input:checked+span:after,
    .like-contact-form-7.form-style-secondary form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form .btn:hover,
    .like-contact-form-7.form-style-secondary form .woocommerce-product-search input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form .wp-searchform input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.post-password-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.search-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.wpcf7-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.comment-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form input[type="submit"]:hover,
    .swiper-pagination .swiper-pagination-bullet,
    .social-big li a,
    .services-sc .arrow-left,
    .services-sc .arrow-right,
    .zs-enabled .zs-slideshow .zs-bullets .zs-bullet.active,
    .zs-enabled.overlay-plain .zs-slideshow::after,
    .color-overlay:after,
    .bg-overlay-dark:after,
    .dark-overlay:after,
    .bg-overlay-black:after,
    .black-overlay:after,
    .woocommerce div.product .woocommerce-tabs ul.tabs li:not(.active):hover,
    .bg-color-black.vc_column_container>.vc_column-inner,
    .bg-color-black.vc_row-fluid,
    .bg-color-black.vc_section,
    .bg-color-black.vc_column_container .vc_column-inner,
    .bg-tone-dark.vc_column_container .vc_column-inner,
    .btn.btn-add-bordered:hover,
    .btn.btn-second:hover {
        background-color: #002c8f;
    }

    #block-footer,
    .vc_message_box.vc_color-info,
    .alert.vc_color-info {
        background-color: #002c8f !important;
    }

    .body-black #block-footer {
        background-color: #002579 !important;
    }

    footer,
    .bg-color-black-dark.vc_row-fluid,
    .bg-color-black-dark.vc_section,
    .bg-color-black-dark.vc_column_container .vc_column-inner,
    body.body-black-dark {
        background-color: #002579;
    }

    body.body-black footer {
        background-color: #001c5c;
    }

    .woocommerce a.button.btn-default:hover,
    .btn.btn-second-bordered,
    .btn.btn-add-bordered:hover,
    .btn-default:hover,
    .btn-default-bordered:hover,
    .btn.btn-black-filled,
    .fw-btn.btn-black-bordered,
    input[type="submit"].btn-black-bordered,
    .btn.btn-black-bordered,
    .wp-searchform input[type="submit"].btn-black-bordered,
    form.post-password-form input[type="submit"].btn-black-bordered,
    form.search-form input[type="submit"].btn-black-bordered,
    form.wpcf7-form input[type="submit"].btn-black-bordered,
    form.form input[type="submit"].btn-black-bordered,
    form.comment-form input[type="submit"].btn-black-bordered,
    form input[type="submit"].btn-black-bordered,
    .fw-btn.btn-black-bordered.btn-xs,
    input[type="submit"].btn-black-bordered.btn-xs,
    .btn.btn-black-bordered.btn-xs,
    .wp-searchform input[type="submit"].btn-black-bordered.btn-xs,
    form.post-password-form input[type="submit"].btn-black-bordered.btn-xs,
    form.search-form input[type="submit"].btn-black-bordered.btn-xs,
    form.wpcf7-form input[type="submit"].btn-black-bordered.btn-xs,
    form.form input[type="submit"].btn-black-bordered.btn-xs,
    form.comment-form input[type="submit"].btn-black-bordered.btn-xs,
    form input[type="submit"].btn-black-bordered.btn-xs {
        border-color: #002c8f;
    }

    .white,
    .testimonials-list .arrow-left,
    .testimonials-list .arrow-right,
    .products-sc .arrow-left,
    .products-sc .arrow-right,
    header.page-header,
    header.page-header .breadcrumbs li a,
    header.page-header .breadcrumbs li::after,
    nav.navbar .nav-right .cart .count,
    #block-footer a:not(.btn),
    body.body-black-dark,
    div.top-bar.container .cart .count,
    .bg-color-theme_color h2,
    .bg-color-black,
    .bg-tone-dark,
    .bg-color-black h1,
    .bg-tone-dark h1,
    .bg-color-black h2,
    .bg-tone-dark h2,
    .bg-color-black h3,
    .bg-tone-dark h3,
    .bg-color-black-dark,
    .bg-color-black-dark h1,
    .bg-color-black-dark h2,
    .bg-color-black-dark h3,
    .comment-text table thead th,
    .text-page table thead th,
    .comment-text table thead th a,
    .text-page table thead th a,
    .heading.subheader-bg-inner .subheader,
    .heading.color-white .header,
    .heading.subcolor-white .subheader,
    .heading.subcolor-gray .subheader,
    .body-black-dark .heading.text-bg .header-text,
    .bg-color-black .heading.text-bg .header-text,
    .icons-floated-top-fastfood a:hover+a>*,
    .block-icons-main .block-icon.layout-cols4 li,
    .multi-doc .block-right,
    .tariff-item.vip,
    .tariff-item.vip .header,
    .tariff-item.vip .ul-no,
    body.body-black-dark .blog article .description .header:hover,
    body.body-black-dark .blog article .blog-info .date-my,
    body.body-black-dark .blog article .blog-info li,
    body.body-black-dark .blog article .blog-info:hover .date-day,
    .gallery-page .photo .fa,
    .woocommerce #payment #place_order,
    .woocommerce-page #payment #place_order,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
    .woocommerce div.product form.cart .button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .button,
    input[type="submit"],
    .wpcf7-submit,
    .btn,
    .btn.btn-second:hover,
    .woocommerce-product-search input[type="submit"],
    .wp-searchform input[type="submit"],
    form.post-password-form input[type="submit"],
    form.search-form input[type="submit"],
    form.wpcf7-form input[type="submit"],
    form.form input[type="submit"],
    form.comment-form input[type="submit"],
    form input[type="submit"],
    .woocommerce #payment #place_order:hover,
    .woocommerce-page #payment #place_order:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
    .woocommerce div.product form.cart .button:hover,
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce button.button:hover,
    .woocommerce input.button:hover,
    .button:hover,
    input[type="submit"]:hover,
    .wpcf7-submit:hover,
    .btn:hover,
    .woocommerce-product-search input[type="submit"]:hover,
    .wp-searchform input[type="submit"]:hover,
    form.post-password-form input[type="submit"]:hover,
    form.search-form input[type="submit"]:hover,
    form.wpcf7-form input[type="submit"]:hover,
    form.form input[type="submit"]:hover,
    form.comment-form input[type="submit"]:hover,
    form input[type="submit"]:hover,
    .woocommerce #payment #place_order.btn-default,
    .woocommerce-page #payment #place_order.btn-default,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-default,
    .woocommerce div.product form.cart .button.btn-default,
    .woocommerce #respond input#submit.btn-default,
    .woocommerce a.button.btn-default,
    .woocommerce button.button.btn-default,
    .woocommerce input.button.btn-default,
    .button.btn-default,
    input[type="submit"].btn-default,
    .wpcf7-submit.btn-default,
    .btn.btn-default,
    .woocommerce-product-search input[type="submit"].btn-default,
    .wp-searchform input[type="submit"].btn-default,
    form.post-password-form input[type="submit"].btn-default,
    form.search-form input[type="submit"].btn-default,
    form.wpcf7-form input[type="submit"].btn-default,
    form.form input[type="submit"].btn-default,
    form.comment-form input[type="submit"].btn-default,
    form input[type="submit"].btn-default,
    .woocommerce #payment #place_order.btn-white-filled:hover,
    .woocommerce-page #payment #place_order.btn-white-filled:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-filled:hover,
    .woocommerce div.product form.cart .button.btn-white-filled:hover,
    .woocommerce #respond input#submit.btn-white-filled:hover,
    .woocommerce a.button.btn-white-filled:hover,
    .woocommerce button.button.btn-white-filled:hover,
    .woocommerce input.button.btn-white-filled:hover,
    .button.btn-white-filled:hover,
    input[type="submit"].btn-white-filled:hover,
    .wpcf7-submit.btn-white-filled:hover,
    .btn.btn-white-filled:hover,
    .woocommerce-product-search input[type="submit"].btn-white-filled:hover,
    .wp-searchform input[type="submit"].btn-white-filled:hover,
    form.post-password-form input[type="submit"].btn-white-filled:hover,
    form.search-form input[type="submit"].btn-white-filled:hover,
    form.wpcf7-form input[type="submit"].btn-white-filled:hover,
    form.form input[type="submit"].btn-white-filled:hover,
    form.comment-form input[type="submit"].btn-white-filled:hover,
    form input[type="submit"].btn-white-filled:hover,
    .woocommerce #payment #place_order.btn-black-filled,
    .woocommerce-page #payment #place_order.btn-black-filled,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black-filled,
    .woocommerce div.product form.cart .button.btn-black-filled,
    .woocommerce #respond input#submit.btn-black-filled,
    .woocommerce a.button.btn-black-filled,
    .woocommerce button.button.btn-black-filled,
    .woocommerce input.button.btn-black-filled,
    .button.btn-black-filled,
    input[type="submit"].btn-black-filled,
    .wpcf7-submit.btn-black-filled,
    .btn.btn-black-filled,
    .woocommerce-product-search input[type="submit"].btn-black-filled,
    .wp-searchform input[type="submit"].btn-black-filled,
    form.post-password-form input[type="submit"].btn-black-filled,
    form.search-form input[type="submit"].btn-black-filled,
    form.wpcf7-form input[type="submit"].btn-black-filled,
    form.form input[type="submit"].btn-black-filled,
    form.comment-form input[type="submit"].btn-black-filled,
    form input[type="submit"].btn-black-filled,
    .woocommerce #payment #place_order.btn-gray-filled:hover,
    .woocommerce-page #payment #place_order.btn-gray-filled:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-gray-filled:hover,
    .woocommerce div.product form.cart .button.btn-gray-filled:hover,
    .woocommerce #respond input#submit.btn-gray-filled:hover,
    .woocommerce a.button.btn-gray-filled:hover,
    .woocommerce button.button.btn-gray-filled:hover,
    .woocommerce input.button.btn-gray-filled:hover,
    .button.btn-gray-filled:hover,
    input[type="submit"].btn-gray-filled:hover,
    .wpcf7-submit.btn-gray-filled:hover,
    .btn.btn-gray-filled:hover,
    .woocommerce-product-search input[type="submit"].btn-gray-filled:hover,
    .wp-searchform input[type="submit"].btn-gray-filled:hover,
    form.post-password-form input[type="submit"].btn-gray-filled:hover,
    form.search-form input[type="submit"].btn-gray-filled:hover,
    form.wpcf7-form input[type="submit"].btn-gray-filled:hover,
    form.form input[type="submit"].btn-gray-filled:hover,
    form.comment-form input[type="submit"].btn-gray-filled:hover,
    form input[type="submit"].btn-gray-filled:hover,
    .woocommerce #payment #place_order.btn-second,
    .woocommerce-page #payment #place_order.btn-second,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-second,
    .woocommerce div.product form.cart .button.btn-second,
    .woocommerce #respond input#submit.btn-second,
    .woocommerce a.button.btn-second,
    .woocommerce button.button.btn-second,
    .woocommerce input.button.btn-second,
    .button.btn-second,
    input[type="submit"].btn-second,
    .wpcf7-submit.btn-second,
    .btn.btn-second,
    .woocommerce-product-search input[type="submit"].btn-second,
    .wp-searchform input[type="submit"].btn-second,
    form.post-password-form input[type="submit"].btn-second,
    form.search-form input[type="submit"].btn-second,
    form.wpcf7-form input[type="submit"].btn-second,
    form.form input[type="submit"].btn-second,
    form.comment-form input[type="submit"].btn-second,
    form input[type="submit"].btn-second,
    .woocommerce #payment #place_order.btn-black,
    .woocommerce-page #payment #place_order.btn-black,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black,
    .woocommerce div.product form.cart .button.btn-black,
    .woocommerce #respond input#submit.btn-black,
    .woocommerce a.button.btn-black,
    .woocommerce button.button.btn-black,
    .woocommerce input.button.btn-black,
    .button.btn-black,
    input[type="submit"].btn-black,
    .wpcf7-submit.btn-black,
    .btn.btn-black,
    .woocommerce-product-search input[type="submit"].btn-black,
    .wp-searchform input[type="submit"].btn-black,
    form.post-password-form input[type="submit"].btn-black,
    form.search-form input[type="submit"].btn-black,
    form.wpcf7-form input[type="submit"].btn-black,
    form.form input[type="submit"].btn-black,
    form.comment-form input[type="submit"].btn-black,
    form input[type="submit"].btn-black,
    .woocommerce #payment #place_order.btn-second-bordered:hover,
    .woocommerce-page #payment #place_order.btn-second-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-second-bordered:hover,
    .woocommerce div.product form.cart .button.btn-second-bordered:hover,
    .woocommerce #respond input#submit.btn-second-bordered:hover,
    .woocommerce a.button.btn-second-bordered:hover,
    .woocommerce button.button.btn-second-bordered:hover,
    .woocommerce input.button.btn-second-bordered:hover,
    .button.btn-second-bordered:hover,
    input[type="submit"].btn-second-bordered:hover,
    .wpcf7-submit.btn-second-bordered:hover,
    .btn.btn-second-bordered:hover,
    .woocommerce #payment #place_order.btn-black-bordered:hover,
    .woocommerce-page #payment #place_order.btn-black-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black-bordered:hover,
    .woocommerce div.product form.cart .button.btn-black-bordered:hover,
    .woocommerce #respond input#submit.btn-black-bordered:hover,
    .woocommerce a.button.btn-black-bordered:hover,
    .woocommerce button.button.btn-black-bordered:hover,
    .woocommerce input.button.btn-black-bordered:hover,
    .button.btn-black-bordered:hover,
    input[type="submit"].btn-black-bordered:hover,
    .wpcf7-submit.btn-black-bordered:hover,
    .btn.btn-black-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-second-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-black-bordered:hover,
    .wp-searchform input[type="submit"].btn-second-bordered:hover,
    .wp-searchform input[type="submit"].btn-black-bordered:hover,
    form.post-password-form input[type="submit"].btn-second-bordered:hover,
    form.post-password-form input[type="submit"].btn-black-bordered:hover,
    form.search-form input[type="submit"].btn-second-bordered:hover,
    form.search-form input[type="submit"].btn-black-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-second-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-black-bordered:hover,
    form.form input[type="submit"].btn-second-bordered:hover,
    form.form input[type="submit"].btn-black-bordered:hover,
    form.comment-form input[type="submit"].btn-second-bordered:hover,
    form.comment-form input[type="submit"].btn-black-bordered:hover,
    form input[type="submit"].btn-second-bordered:hover,
    form input[type="submit"].btn-black-bordered:hover,
    .woocommerce #payment #place_order.btn-white-bordered,
    .woocommerce-page #payment #place_order.btn-white-bordered,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-bordered,
    .woocommerce div.product form.cart .button.btn-white-bordered,
    .woocommerce #respond input#submit.btn-white-bordered,
    .woocommerce a.button.btn-white-bordered,
    .woocommerce button.button.btn-white-bordered,
    .woocommerce input.button.btn-white-bordered,
    .button.btn-white-bordered,
    input[type="submit"].btn-white-bordered,
    .wpcf7-submit.btn-white-bordered,
    .btn.btn-white-bordered,
    .woocommerce-product-search input[type="submit"].btn-white-bordered,
    .wp-searchform input[type="submit"].btn-white-bordered,
    form.post-password-form input[type="submit"].btn-white-bordered,
    form.search-form input[type="submit"].btn-white-bordered,
    form.wpcf7-form input[type="submit"].btn-white-bordered,
    form.form input[type="submit"].btn-white-bordered,
    form.comment-form input[type="submit"].btn-white-bordered,
    form input[type="submit"].btn-white-bordered,
    .woocommerce #payment #place_order.btn-add,
    .woocommerce-page #payment #place_order.btn-add,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-add,
    .woocommerce div.product form.cart .button.btn-add,
    .woocommerce #respond input#submit.btn-add,
    .woocommerce a.button.btn-add,
    .woocommerce button.button.btn-add,
    .woocommerce input.button.btn-add,
    .button.btn-add,
    input[type="submit"].btn-add,
    .wpcf7-submit.btn-add,
    .btn.btn-add,
    .woocommerce-product-search input[type="submit"].btn-add,
    .wp-searchform input[type="submit"].btn-add,
    form.post-password-form input[type="submit"].btn-add,
    form.search-form input[type="submit"].btn-add,
    form.wpcf7-form input[type="submit"].btn-add,
    form.form input[type="submit"].btn-add,
    form.comment-form input[type="submit"].btn-add,
    form input[type="submit"].btn-add,
    .woocommerce #payment #place_order.btn-add:hover,
    .woocommerce-page #payment #place_order.btn-add:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-add:hover,
    .woocommerce div.product form.cart .button.btn-add:hover,
    .woocommerce #respond input#submit.btn-add:hover,
    .woocommerce a.button.btn-add:hover,
    .woocommerce button.button.btn-add:hover,
    .woocommerce input.button.btn-add:hover,
    .button.btn-add:hover,
    input[type="submit"].btn-add:hover,
    .wpcf7-submit.btn-add:hover,
    .btn.btn-add:hover,
    .woocommerce-product-search input[type="submit"].btn-add:hover,
    .wp-searchform input[type="submit"].btn-add:hover,
    form.post-password-form input[type="submit"].btn-add:hover,
    form.search-form input[type="submit"].btn-add:hover,
    form.wpcf7-form input[type="submit"].btn-add:hover,
    form.form input[type="submit"].btn-add:hover,
    form.comment-form input[type="submit"].btn-add:hover,
    form input[type="submit"].btn-add:hover,
    .woocommerce #payment #place_order.btn-add-bordered:hover,
    .woocommerce-page #payment #place_order.btn-add-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-add-bordered:hover,
    .woocommerce div.product form.cart .button.btn-add-bordered:hover,
    .woocommerce #respond input#submit.btn-add-bordered:hover,
    .woocommerce a.button.btn-add-bordered:hover,
    .woocommerce button.button.btn-add-bordered:hover,
    .woocommerce input.button.btn-add-bordered:hover,
    .button.btn-add-bordered:hover,
    input[type="submit"].btn-add-bordered:hover,
    .wpcf7-submit.btn-add-bordered:hover,
    .btn.btn-add-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-add-bordered:hover,
    .wp-searchform input[type="submit"].btn-add-bordered:hover,
    form.post-password-form input[type="submit"].btn-add-bordered:hover,
    form.search-form input[type="submit"].btn-add-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-add-bordered:hover,
    form.form input[type="submit"].btn-add-bordered:hover,
    form.comment-form input[type="submit"].btn-add-bordered:hover,
    form input[type="submit"].btn-add-bordered:hover,
    .woocommerce #payment #place_order.color-text-white,
    .woocommerce-page #payment #place_order.color-text-white,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-text-white,
    .woocommerce div.product form.cart .button.color-text-white,
    .woocommerce #respond input#submit.color-text-white,
    .woocommerce a.button.color-text-white,
    .woocommerce button.button.color-text-white,
    .woocommerce input.button.color-text-white,
    .button.color-text-white,
    input[type="submit"].color-text-white,
    .wpcf7-submit.color-text-white,
    .btn.color-text-white,
    .woocommerce-product-search input[type="submit"].color-text-white,
    .wp-searchform input[type="submit"].color-text-white,
    form.post-password-form input[type="submit"].color-text-white,
    form.search-form input[type="submit"].color-text-white,
    form.wpcf7-form input[type="submit"].color-text-white,
    form.form input[type="submit"].color-text-white,
    form.comment-form input[type="submit"].color-text-white,
    form input[type="submit"].color-text-white,
    .woocommerce #payment #place_order.color-hover-main:hover,
    .woocommerce-page #payment #place_order.color-hover-main:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-hover-main:hover,
    .woocommerce div.product form.cart .button.color-hover-main:hover,
    .woocommerce #respond input#submit.color-hover-main:hover,
    .woocommerce a.button.color-hover-main:hover,
    .woocommerce button.button.color-hover-main:hover,
    .woocommerce input.button.color-hover-main:hover,
    .button.color-hover-main:hover,
    input[type="submit"].color-hover-main:hover,
    .wpcf7-submit.color-hover-main:hover,
    .btn.color-hover-main:hover,
    .woocommerce-product-search input[type="submit"].color-hover-main:hover,
    .wp-searchform input[type="submit"].color-hover-main:hover,
    form.post-password-form input[type="submit"].color-hover-main:hover,
    form.search-form input[type="submit"].color-hover-main:hover,
    form.wpcf7-form input[type="submit"].color-hover-main:hover,
    form.form input[type="submit"].color-hover-main:hover,
    form.comment-form input[type="submit"].color-hover-main:hover,
    form input[type="submit"].color-hover-main:hover,
    .woocommerce #payment #place_order.color-hover-second:hover,
    .woocommerce-page #payment #place_order.color-hover-second:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-hover-second:hover,
    .woocommerce div.product form.cart .button.color-hover-second:hover,
    .woocommerce #respond input#submit.color-hover-second:hover,
    .woocommerce a.button.color-hover-second:hover,
    .woocommerce button.button.color-hover-second:hover,
    .woocommerce input.button.color-hover-second:hover,
    .button.color-hover-second:hover,
    input[type="submit"].color-hover-second:hover,
    .wpcf7-submit.color-hover-second:hover,
    .btn.color-hover-second:hover,
    .woocommerce-product-search input[type="submit"].color-hover-second:hover,
    .wp-searchform input[type="submit"].color-hover-second:hover,
    form.post-password-form input[type="submit"].color-hover-second:hover,
    form.search-form input[type="submit"].color-hover-second:hover,
    form.wpcf7-form input[type="submit"].color-hover-second:hover,
    form.form input[type="submit"].color-hover-second:hover,
    form.comment-form input[type="submit"].color-hover-second:hover,
    form input[type="submit"].color-hover-second:hover,
    .woocommerce #payment #place_order.color-hover-black:hover,
    .woocommerce-page #payment #place_order.color-hover-black:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.color-hover-black:hover,
    .woocommerce div.product form.cart .button.color-hover-black:hover,
    .woocommerce #respond input#submit.color-hover-black:hover,
    .woocommerce a.button.color-hover-black:hover,
    .woocommerce button.button.color-hover-black:hover,
    .woocommerce input.button.color-hover-black:hover,
    .button.color-hover-black:hover,
    input[type="submit"].color-hover-black:hover,
    .wpcf7-submit.color-hover-black:hover,
    .btn.color-hover-black:hover,
    .woocommerce-product-search input[type="submit"].color-hover-black:hover,
    .wp-searchform input[type="submit"].color-hover-black:hover,
    form.post-password-form input[type="submit"].color-hover-black:hover,
    form.search-form input[type="submit"].color-hover-black:hover,
    form.wpcf7-form input[type="submit"].color-hover-black:hover,
    form.form input[type="submit"].color-hover-black:hover,
    form.comment-form input[type="submit"].color-hover-black:hover,
    form input[type="submit"].color-hover-black:hover,
    .like-contact-form-7.form-style-secondary form input[type="submit"],
    .like-contact-form-7.form-style-secondary form .btn,
    .like-contact-form-7.form-style-secondary form .woocommerce-product-search input[type="submit"],
    .like-contact-form-7.form-style-secondary form .wp-searchform input[type="submit"],
    .like-contact-form-7.form-style-secondary form form.post-password-form input[type="submit"],
    .like-contact-form-7.form-style-secondary form form.search-form input[type="submit"],
    .like-contact-form-7.form-style-secondary form form.wpcf7-form input[type="submit"],
    .like-contact-form-7.form-style-secondary form form.form input[type="submit"],
    .like-contact-form-7.form-style-secondary form form.comment-form input[type="submit"],
    .like-contact-form-7.form-style-secondary form form input[type="submit"],
    .like-contact-form-7.form-style-secondary form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form .btn:hover,
    .like-contact-form-7.form-style-secondary form .woocommerce-product-search input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form .wp-searchform input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.post-password-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.search-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.wpcf7-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form.comment-form input[type="submit"]:hover,
    .like-contact-form-7.form-style-secondary form form input[type="submit"]:hover,
    .vc_message_box.vc_color-info .fa,
    .alert.alert-important .fa,
    .alert.alert-important .header,
    .alert.alert-important p,
    .alert.alert-warning p,
    .social-big li a,
    .block-icon.layout-cols6 li a:hover+h5,
    .block-icon.icon-ht-left a,
    .block-icon.icon-ht-right a,
    .block-icon.icon-ht-left span,
    .block-icon.icon-ht-right span,
    .block-icon.icon-top a,
    .block-icon.icon-top span,
    .block-icon li .bg-main,
    a.video span,
    .tabs-cats.menu-filter li span:hover,
    .tabs-cats.menu-filter li .cat-active,
    .bg-color-black .products-sc,
    .services-sc .arrow-left:not(.swiper-button-disabled):hover,
    .services-sc .arrow-right:not(.swiper-button-disabled):hover,
    .product-block .side-b,
    .slider-zoom.zoom-color-white,
    .zs-enabled .zs-arrows .arrow-right:before,
    .zs-enabled .zs-arrows .arrow-left:before,
    .zs-enabled .zs-arrows .arrow-right:after,
    .zs-enabled .zs-arrows .arrow-left:after,
    .image-header .header,
    .woocommerce span.onsale,
    .woocommerce ul.products li.product .button:hover:before,
    .woocommerce div.product .woocommerce-tabs ul.tabs li a,
    .woocommerce div.product .woocommerce-tabs ul.tabs li:not(.active):hover a {
        color: #ffffff;
    }

    .block-descr .date,
    .vc_tta-accordion .vc_tta-panel-body,
    .wpcf7-form-control-wrap.to.phone:after,
    .wpcf7-form-control-wrap.phone.phone:after,
    .wpcf7-form-control-wrap.date.phone:after,
    .wpcf7-form-control-wrap.cartype.phone:after,
    .wpcf7-form-control-wrap.address.phone:after,
    .wpcf7-form-control-wrap.to:after,
    .wpcf7-form-control-wrap.phone:after,
    .wpcf7-form-control-wrap.date:after,
    .wpcf7-form-control-wrap.cartype:after,
    .wpcf7-form-control-wrap.address:after {
        color: rgba(255, 255, 255, .5) !important;
    }

    @media (min-width: 1199px) {
        nav.navbar ul.navbar-nav>li.current-menu-ancestor>a nav.navbar ul.navbar-nav>li.current-menu-item>a nav.navbar ul.navbar-nav>li.current-menu-parent>a nav.navbar ul.navbar-nav>li.current_page_parent>a nav.navbar ul.navbar-nav>li.current_page_item>a {
            color: #ffffff !important;
        }
        nav.navbar #navbar ul.navbar-nav ul.children li:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-item:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current-menu-item:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-parent:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current-menu-parent:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_parent:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current_page_parent:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_item:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current_page_item:hover>a,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-item:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current-menu-item:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.children li.current-menu-parent:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current-menu-parent:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_parent:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current_page_parent:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.children li.current_page_item:hover>a:after,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu li.current_page_item:hover>a:after {
            color: #ffffff;
        }
    }

    #block-footer .social-small a:hover,
    .woocommerce ul.products li.product .button:hover,
    .woocommerce .swiper-container .arrow-left:hover,
    .woocommerce .swiper-container .arrow-right:hover {
        color: #ffffff !important;
    }

    body,
    .testimonials-list .arrow-left:hover,
    .testimonials-list .arrow-right:hover,
    nav.navbar.navbar-default .navbar-toggle .icon-bar,
    div.top-bar.container,
    nav.navbar,
    .content-shadow-bottom>.vc_row:last-child>div>div>.wpb_wrapper,
    .tariff-item,
    footer .go-top:hover,
    form textarea,
    form input[type="password"],
    form input[type="search"],
    form input[type="email"],
    form input[type="tel"],
    form input[type="text"],
    .select-wrap,
    .woocommerce #payment #place_order.btn-white-filled,
    .woocommerce-page #payment #place_order.btn-white-filled,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-filled,
    .woocommerce div.product form.cart .button.btn-white-filled,
    .woocommerce #respond input#submit.btn-white-filled,
    .woocommerce a.button.btn-white-filled,
    .woocommerce button.button.btn-white-filled,
    .woocommerce input.button.btn-white-filled,
    .button.btn-white-filled,
    input[type="submit"].btn-white-filled,
    .wpcf7-submit.btn-white-filled,
    .btn.btn-white-filled,
    .woocommerce-product-search input[type="submit"].btn-white-filled,
    .wp-searchform input[type="submit"].btn-white-filled,
    form.post-password-form input[type="submit"].btn-white-filled,
    form.search-form input[type="submit"].btn-white-filled,
    form.wpcf7-form input[type="submit"].btn-white-filled,
    form.form input[type="submit"].btn-white-filled,
    form.comment-form input[type="submit"].btn-white-filled,
    form input[type="submit"].btn-white-filled,
    form input[type="submit"].btn-black:hover,
    .woocommerce #payment #place_order.btn-white-bordered:hover,
    .woocommerce-page #payment #place_order.btn-white-bordered:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-bordered:hover,
    .woocommerce div.product form.cart .button.btn-white-bordered:hover,
    .woocommerce #respond input#submit.btn-white-bordered:hover,
    .woocommerce a.button.btn-white-bordered:hover,
    .woocommerce button.button.btn-white-bordered:hover,
    .woocommerce input.button.btn-white-bordered:hover,
    .button.btn-white-bordered:hover,
    input[type="submit"].btn-white-bordered:hover,
    .wpcf7-submit.btn-white-bordered:hover,
    .btn.btn-white-bordered:hover,
    .woocommerce-product-search input[type="submit"].btn-white-bordered:hover,
    .wp-searchform input[type="submit"].btn-white-bordered:hover,
    form.post-password-form input[type="submit"].btn-white-bordered:hover,
    form.search-form input[type="submit"].btn-white-bordered:hover,
    form.wpcf7-form input[type="submit"].btn-white-bordered:hover,
    form.form input[type="submit"].btn-white-bordered:hover,
    form.comment-form input[type="submit"].btn-white-bordered:hover,
    form input[type="submit"].btn-white-bordered:hover,
    form.comment-form input[type="submit"].color-hover-white:hover,
    form input[type="submit"].color-hover-white:hover,
    label.css-radio>span:before,
    .alert,
    .team-item.item-type-square,
    .products-sc article,
    .services-sc article,
    .services-sc .arrow-left.swiper-button-disabled,
    .services-sc .arrow-right.swiper-button-disabled,
    .product-block .side-a,
    .image-header,
    .image-header .photo:before,
    .slider-sc .swiper-slide,
    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
    .woocommerce table.shop_table.woocommerce-checkout-review-order-table td,
    .woocommerce-checkout #payment div.payment_box {
        background-color: #ffffff;
    }

    @media (min-width: 1200px) {
        nav.navbar #navbar ul.navbar-nav ul.children,
        nav.navbar #navbar ul.navbar-nav ul.sub-menu {
            background-color: #ffffff;
        }
    }

    @media (max-width: 1199px) {
        nav.navbar #navbar .navbar-toggle .icon-bar,
        nav.navbar ul.navbar-nav ul {
            background-color: #ffffff;
        }
    }

    .color-hover-white:hover,
    .vc_message_box {
        background-color: #ffffff !important;
    }

    .woocommerce #payment #place_order.btn-white-bordered,
    .woocommerce-page #payment #place_order.btn-white-bordered,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-white-bordered,
    .woocommerce div.product form.cart .button.btn-white-bordered,
    .woocommerce #respond input#submit.btn-white-bordered,
    .woocommerce a.button.btn-white-bordered,
    .woocommerce button.button.btn-white-bordered,
    .woocommerce input.button.btn-white-bordered,
    .button.btn-white-bordered,
    input[type="submit"].btn-white-bordered,
    .wpcf7-submit.btn-white-bordered,
    .btn.btn-white-bordered,
    .woocommerce-product-search input[type="submit"].btn-white-bordered,
    .wp-searchform input[type="submit"].btn-white-bordered,
    form.post-password-form input[type="submit"].btn-white-bordered,
    form.search-form input[type="submit"].btn-white-bordered,
    form.wpcf7-form input[type="submit"].btn-white-bordered,
    form.form input[type="submit"].btn-white-bordered,
    form.comment-form input[type="submit"].btn-white-bordered,
    form input[type="submit"].btn-white-bordered,
    .countUp-item,
    .open-hours .vc_row,
    .woocommerce #payment #place_order.btn-black:hover,
    .woocommerce-page #payment #place_order.btn-black:hover,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button.btn-black:hover,
    .woocommerce div.product form.cart .button.btn-black:hover,
    .woocommerce #respond input#submit.btn-black:hover,
    .woocommerce a.button.btn-black:hover,
    .woocommerce button.button.btn-black:hover,
    .woocommerce input.button.btn-black:hover,
    .button.btn-black:hover,
    input[type="submit"].btn-black:hover,
    .wpcf7-submit.btn-black:hover,
    .btn.btn-black:hover,
    .woocommerce-product-search input[type="submit"].btn-black:hover,
    .wp-searchform input[type="submit"].btn-black:hover,
    form.post-password-form input[type="submit"].btn-black:hover,
    form.search-form input[type="submit"].btn-black:hover,
    form.wpcf7-form input[type="submit"].btn-black:hover,
    form.form input[type="submit"].btn-black:hover,
    form.comment-form input[type="submit"].btn-black:hover,
    form input[type="submit"].btn-black:hover,
    .zs-enabled .zs-slideshow .zs-bullets .zs-bullet.active {
        border-color: #ffffff;
    }

    @media (max-width: 1199px) {
        nav.navbar ul.navbar-nav li.menu-item-has-children:after {
            color: #002c8f;
        }
        nav.navbar #navbar {
            background-color: #21b6ff;
        }
        nav.navbar ul.navbar-nav li>a:hover {
            background-color: #AEC556;
            color: #21b6ff;
        }
        nav.navbar #navbar ul.navbar-nav>li.current-menu-ancestor>a::after,
        nav.navbar #navbar ul.navbar-nav>li.current-menu-parent>a::after,
        nav.navbar #navbar ul.navbar-nav>.current_page_item>a,
        nav.navbar #navbar ul.navbar-nav>.current_page_item>a:after,
        nav.navbar ul.navbar-nav>li.current_page_parent>a,
        nav.navbar ul.navbar-nav>li.current_page_parent>a:after,
        nav.navbar ul.navbar-nav>li.current_page_item>a,
        nav.navbar ul.navbar-nav>li.current_page_item>a:after {
            color: #ffffff !important;
        }
        ul.sub-menu li:hover>a,
        ul.sub-menu li:hover>a:after,
        ul.sub-menu li>a:hover,
        ul.sub-menu li>a:hover:after,
        nav.navbar ul.navbar-nav>li>a:hover:after,
        nav.navbar ul.navbar-nav>li>a:hover .fa,
        nav.navbar ul.navbar-nav>li>a:hover {
            color: #ffffff !important;
        }
    }

    body.admin-bar #adminbarsearch {
        background-color: transparent !important;
    }

    html,
    body,
    div,
    table {
        font-family: 'Open Sans';
        font-weight: 400;
    }

    h1,
    h2,
    h3,
    h4,
    .header,
    .font-headers,
    .breadcrumbs {
        font-family: 'Merriweather';
        font-weight: 900;
    }

    #navbar>ul>li>a:not(.fa) {
        font-family: 'Merriweather';
        font-weight: 900;
    }

    .font-main {
        font-family: 'Open Sans';
    }
</style>
<link rel='stylesheet' id='aquaterias_google_fonts-css'
      href="{{ asset('frontend/css/fonts.googleapis.css') }}" type='text/css' media='all'/>
<script type='text/javascript' src="{{ asset('frontend/wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4') }}"></script>
{{--    <script type='text/javascript' src="{{ asset('frontend/js/jquery.js') }}"></script>--}}
{{--<script type='text/javascript' src="{{ asset('frontend/js/popper.js') }}">js</script>--}}
{{--<script type='text/javascript' src="{{ asset('frontend/js/bootstrap.js') }}"></script>--}}
{{--    <script src="https://kit.fontawesome.com/a076d05399.js"></script>--}}
<script type='text/javascript'>
    var wc_add_to_cart_params = {
        "ajax_url": "\/wp-admin\/admin-ajax.php",
        "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
        "i18n_view_cart": "View cart",
        "cart_url": "http:\/\/aquaterias.like-themes.com\/cart\/",
        "is_cart": "",
        "cart_redirect_after_add": "no"
    };
</script>
<!--[if lt IE 9]>
<script type='text/javascript' src="{{ asset('frontend/js/aquaterias.themes.html5shiv') }}"></script> <![endif]-->
<link rel='https://api.w.org/' href="{{ asset('frontend/wp-json/index.html') }}"/>
<link rel="EditURI" type="application/rsd+xml" title="RSD"
      href="{{ asset('frontend/xmlrpc0db0.html?rsd') }}"/>
<link rel="wlwmanifest" type="application/wlwmanifest+xml"
      href="{{ asset('frontend/wp-includes/wlwmanifest.xml') }}"/>
<meta name="generator" content="WordPress 5.1.6"/>
<meta name="generator" content="WooCommerce 3.5.5"/>
<link rel="canonical" href="{{ asset('frontend/index.html') }}"/>
<link rel='shortlink' href="{{ asset('frontend/index.html') }}"/>
<link rel="alternate" type="application/json+oembed"
      href="{{ asset('frontend/wp-json/oembed/1.0/embedf0cd.json?url=http%3A%2F%2Faquaterias.like-themes.com%2F') }}"/>
<link rel="alternate" type="text/xml+oembed"
      href="{{ asset('frontend/wp-json/oembed/1.0/embed9613?url=http%3A%2F%2Faquaterias.like-themes.com%2F&amp;format=xml') }}"/>
<meta name="tec-api-version" content="v1">
{{-- <meta name="tec-api-origin" content="http://aquaterias.like-themes.com"> --}}
<link rel="https://theeventscalendar.com/"
      href="{{ asset('frontend/wp-json/tribe/events/v1/index.html') }}"/>
<noscript>
    <style>
        .woocommerce-product-gallery {
            opacity: 1 !important;
        }

    </style>
</noscript>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vc_lte.css') }}" media="screen">
<![endif]-->
<link rel="icon"
      href="{{ asset('frontend/wp-content/uploads/2017/12/cropped-favicon-7-100x100.png')  }} "
      sizes="32x32"/>
<link rel="icon"
      href="{{ asset('frontend/wp-content/uploads/2017/12/cropped-favicon-7-300x300.png') }}"
      sizes="192x192"/>
<link rel="apple-touch-icon-precomposed"
      href="{{ asset('frontend/wp-content/uploads/2017/12/cropped-favicon-7-300x300.png') }}"/>
<meta name="msapplication-TileImage"
      content="{{ asset('frontend/wp-content/uploads/2017/12/cropped-favicon-7-300x300.png') }}"/>
<style type="text/css" data-type="vc_shortcodes-custom-css">

    .vc_custom_1513620393970 {
        background-image: url(../wp-content/uploads/2017/12/video_bga583.png?id=2912) !important;
    }

    .vc_custom_1515771135702 {
        margin-top: 0px !important;
    }

    .vc_custom_1514245531220 {
        margin-top: 6px !important;
        margin-bottom: 20px !important;
    }

    .vc_custom_1514245538346 {
        margin-top: 0px !important;
        margin-bottom: 6px !important;
    }

    .vc_custom_1514245570517 {
        margin-bottom: 18px !important;
    }

    .vc_custom_1514165431889 {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .vc_custom_1514245575021 {
        margin-bottom: 18px !important;
    }

    .vc_custom_1514245254327 {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .vc_custom_1514245580032 {
        margin-bottom: 18px !important;
    }

    .vc_custom_1514245261016 {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .vc_custom_1514245584321 {
        margin-bottom: 18px !important;
    }

    .vc_custom_1514245272940 {
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }

    .vc_custom_1513620675866 {
        background-image: url(true?id=) !important;
    }
</style>
<noscript>
    <style type="text/css">
        .wpb_animate_when_almost_visible {
            opacity: 1;
        }
    </style>
</noscript>
