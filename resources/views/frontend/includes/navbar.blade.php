
<div id="nav-wrapper" class="bootstrap-iso" >
    <nav class="navbar navbar-default navbar-fixed-top" id="mNavbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
                <a class="logo" href="" style="margin-top: -10px">
                    <img src="{{ asset('images/logo/CfreshNew.png') }}"
                         class="attachment-full size-full" alt="" style="width: 150px !important;"/>
                </a>
            </div>
            <div class="pull-right nav-right">

                <div id="top-search" class="top-search">
                    <a href="#" id="top-search-ico" class="fa fa-search" aria-hidden="true"></a>
                    <input placeholder="Search" value="" type="text">
                </div>

                <a href="{{ route('cart') }}" class="shop_table cart"
                   title="View your shopping cart">
                    <span class="name">Cart</span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    @if(Session::has('cart'))
                        <span class="cart-contents header-cart-count count">{{ Session::get('cart')->totalQty }}</span>
                    @endif
                </a>
                @if(Session::has('user'))
                    <a href="{{route('user.logout')}}" class="shop_table cart"
                       title="Sign Out">
                        <span class="name">User Account</span>
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                @endif


            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="toggle-wrap">
                    <button type="button" class="navbar-toggle collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                    <div class="clearfix"></div>
                </div>
                <ul id="menu-main-menu" class="nav navbar-nav">
                    <li id="menu-item-3127"
                        class="menu-item menu-item-type-post_type menu-item-object-page current_page_ancestor {{Request::is('/') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-3127">
                        <a href="{{route('home')}}" >
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    <li id="menu-item-3127"
                        class="menu-item menu-item-type-post_type menu-item-object-page current_page_ancestor {{Request::is('shop') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-3127">
                        <a href="{{route('shop')}}" >
                            <i class="fa fa-shopping-bag"></i> <span>Shop</span>
                        </a>
                    </li>
                    {{--<li id="menu-item-3127"
                        class="menu-item menu-item-type-post_type menu-item-object-page current_page_ancestor {{Request::is('cart') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-3127">
                        <a href="{{route('cart')}}" >
                            <span>Cart</span>
                        </a>
                    </li>--}}
                    <li id="menu-item-3127"
                        class="menu-item menu-item-type-post_type menu-item-object-page current_page_ancestor {{Request::is('checkout') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-3127">
                        <a href="{{route('checkout')}}" >
                            <i class="fa fa-cart-plus"></i> <span>Checkout</span>
                        </a>
                    </li>
                    <li id="menu-item-3128"

                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  {{Request::is('about-us') || Request::is('faq') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-3128">
                        <a href="" >
                            <span>About us</span>
                        </a>
                        <ul class="sub-menu">
                            <li id="menu-item-3129"
                                class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-3129">
                                <a href="{{route('about')}}">
                                    <span>About us</span>
                                </a>
                            </li>
                            {{--                            <li id="menu-item-57"--}}
                            {{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-57">--}}
                            {{--                                <a href="testimonials/index.html">--}}
                            {{--                                    <span>Testimonials</span>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            <li id="menu-item-750"--}}
                            {{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-750">--}}
                            {{--                                <a href="team/index.html">--}}
                            {{--                                    <span>Team</span>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li id="menu-item-2364"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3129">
                                <a href="{{route('faq')}}">
                                    <span>FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--<li id="menu-item-619" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children {{ Request::is('cart') || Request::is('checkout') ? 'current-menu-ancestor current-menu-parent' : ''}} menu-item-619">
                        <a href="" >
                            <span>Products</span>
                        </a>
                        <ul class="sub-menu">
--}}{{--                            <li id="menu-item-623"--}}{{--
--}}{{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-623">--}}{{--
--}}{{--                                <a href="{{route('shop')}}">--}}{{--
--}}{{--                                    <span>Shop</span>--}}{{--
--}}{{--                                </a>--}}{{--
--}}{{--                            </li>--}}{{--
--}}{{--                            <li id="menu-item-622"--}}{{--
--}}{{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-622">--}}{{--
--}}{{--                                <a href="{{route('cart')}}">--}}{{--
--}}{{--                                    <span>Cart</span>--}}{{--
--}}{{--                                </a>--}}{{--
--}}{{--                            </li>--}}{{--
--}}{{--                            <li id="menu-item-621"--}}{{--
--}}{{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-621">--}}{{--
--}}{{--                                <a href="{{route('checkout')}}">--}}{{--
--}}{{--                                    <span>Checkout</span>--}}{{--
--}}{{--                                </a>--}}{{--
--}}{{--                            </li>--}}{{--
--}}{{--                            <li id="menu-item-620"--}}{{--
--}}{{--                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-620">--}}{{--
--}}{{--                                <a href="my-account/index.html">--}}{{--
--}}{{--                                    <span>My account</span>--}}{{--
--}}{{--                                </a>--}}{{--
--}}{{--                            </li>--}}{{--
                        </ul>
                    </li>
                   --}}{{-- <li id="menu-item-59"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-59">
                        <a><span>Blog</span></a>
                        <ul class="sub-menu">
                            <li id="menu-item-43"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-43">
                                <a href="blog-one-column/index.html">
                                    <span>Blog One Column</span>
                                </a>
                            </li>
                            <li id="menu-item-45"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-45">
                                <a href="blog-two-columns/index.html">
                                    <span>Blog Two Columns</span>
                                </a>
                            </li>
                            <li id="menu-item-44"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-44">
                                <a href="blog-three-columns/index.html">
                                    <span>Blog Three Columns</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="menu-item-60"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-60">
                        <a><span>Gallery</span></a>
                        <ul class="sub-menu">
                            <li id="menu-item-47"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-47">
                                <a href="gallery-2-columns/index.html">
                                    <span>Gallery 2-columns</span>
                                </a>
                            </li>
                            <li id="menu-item-48"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-48">
                                <a href="gallery-3-columns/index.html">
                                    <span>Gallery 3-columns</span>
                                </a>
                            </li>
                            <li id="menu-item-49"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-49">
                                <a href="gallery-4-columns/index.html">
                                    <span>Gallery 4-columns</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="menu-item-46"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-46">
                        <a href="contacts/index.html">
                            <span>Contacts</span>
                        </a>
                    </li>
                    <li id="menu-item-61"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-61">
                        <a href="#">
                            <span>Pages</span>
                        </a>
                        <ul class="sub-menu">
                            <li id="menu-item-783"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-783">
                                <a><span>Typography</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-597"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-597">
                                        <a href="headers/index.html">
                                            <span>Headers</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-579"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-579">
                                        <a href="text/index.html">
                                            <span>Text</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-594"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-594">
                                        <a href="text_columns/index.html">
                                            <span>Text Columns</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-643"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-643">
                                        <a href="table/index.html">
                                            <span>Table</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-588"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-588">
                                        <a href="separators/index.html">
                                            <span>Separators</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li id="menu-item-784"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-784">
                                <a><span>Form Elements</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-555"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-555">
                                        <a href="buttons/index.html">
                                            <span>Buttons</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-705"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-705">
                                        <a href="forms/index.html">
                                            <span>Forms</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li id="menu-item-785"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-785">
                                <a><span>Shortcodes</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-527"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-527">
                                        <a href="accordions/index.html">
                                            <span>Accordions</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-538"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-538">
                                        <a href="alert/index.html">
                                            <span>Alerts</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-568"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-568">
                                        <a href="tabs/index.html">
                                            <span>Tabs</span>
                                        </a>
                                    </li>
                                    <li id="menu-item-56"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-56">
                                        <a href="shortcodes/index.html">
                                            <span>Shortcodes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li id="menu-item-786"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-786">
                                <a href="#"><span>Lists</span></a>
                                <ul class="sub-menu">
                                    <li id="menu-item-675"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-675">
                                        <a href="icons-page/index.html"><span>Icons</span></a>
                                    </li>
                                    <li id="menu-item-562"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-562">
                                        <a href="list/index.html"><span>Lists and Social Icons</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li id="menu-item-2584"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2584">
                                <a href="404-page.html"><span>404 Page</span></a>
                            </li>
                        </ul>
                    </li>--}}
                </ul>
                <div class="nav-mob">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{route('cart')}}" class="shop_table cart-mob" title="View your shopping cart">
                                @if(Session::has('cart'))
                                    <span class="cart-contents header-cart-count count">{{ Session::get('cart')->totalQty }}</span>
                                @endif
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="name">Cart</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
