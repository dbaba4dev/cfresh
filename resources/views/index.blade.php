@extends('frontend.layouts.master')
{{--@section('klass','active')--}}

@section('styles')

@endsection

@section('page-header')

@endsection

@section('content')
    <div class="container" >
        @include('frontend.includes.slider')
    </div>
    <!-- ================ start banner area ================= -->
{{--    <section class="blog-banner-area" id="category" style="max-height: 80px">--}}
{{--        <div class="container h-100">--}}
{{--            <div class="blog-banner">--}}
{{--                <div class="text-center">--}}
{{--                    <h1>Shop Category</h1>--}}
{{--                    <nav aria-label="breadcrumb" class="banner-breadcrumb">--}}
{{--                        <ol class="breadcrumb">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">Shop Category</li>--}}
{{--                        </ol>--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- ================ end banner area ================= -->


    <!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5" style="margin-top: 1rem">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-filter">
                        <div class="top-filter-head">Product Category</div>
                        <div class="common-filter">
                            <div class="head">Brands (Case Type)</div>
                            <form action="#">
                                <ul>
                                    @foreach($products as $product)
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">{{$product->case}}
                                            <span> ({{(\App\Store::where('box_id',$product->id)->where('flow','In flow')->sum('quantity'))-
                          (\App\Store::where('box_id',$product->id)->where('flow','Out flow')->sum('quantity'))}})</span></label></li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <div class="sorting">
                            <select>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                                <option value="1">Default sorting</option>
                            </select>
                        </div>
                        <div class="sorting mr-auto">
                            <select>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                                <option value="1">Show 12</option>
                            </select>
                        </div>
                        <div>
                            <div class="input-group filter-bar-search">
                                <input type="text" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter Bar -->
                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="card text-center card-product">
                                    <div class="card-product__img">
                                        <img class="card-img" src="{{'images/backends_images/products/'.$product->image}}" alt="">
                                        <ul class="card-product__imgOverlay">
                                            <li><a href="{{route('product.detail',['id'=>$product->id])}}" class="button btn-sm" style="width: 20px"><i class="ti-search"></i></a></li>
                                            <li><a href="" class="button btn-sm"><i class="ti-shopping-cart"></i></a></li>
{{--                                            <li><button><i class="ti-heart "></i></button></li>--}}
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <p>Packages</p>
                                        <h4 class="card-product__title"><a href="#">{{$product->case}}</a></h4>
                                        <p class="card-product__price">&#8358 {{$product->price}}</p>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
    <!-- ================ category section end ================= -->



    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
        <div class="container">
            <div class="subscribe text-center">
                <h3 class="subscribe__title">Get Update From Anywhere</h3>
                <p>Bearing Void gathering light light his eavening unto dont afraid</p>
                <div id="mc_embed_signup">
                    <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
                        <div class="form-group ml-sm-auto">
                            <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" >
                            <div class="info"></div>
                        </div>
                        <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ================ Subscribe section end ================= -->


@endsection

@section('scripts')

@endsection