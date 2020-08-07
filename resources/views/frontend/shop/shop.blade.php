@extends('frontend.layouts.master')
@push('css')
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">--}}
{{--    <link href="{{asset('frontend/css/bootstrap-iso.css')}}" rel="stylesheet">--}}
    <link href="{{asset('frontend/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/shop.css')}}" rel="stylesheet">
    <script type='text/javascript' src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/js/bootstrap.js') }}"></script>
@endpush
{{--@push('breadcrumb')--}}

{{--@endpush--}}
@section('page-title','All Products')
@section('page-sub_title','Products')
@section('content')
    <div class="container">
        <div class="inner-page margin-default">
            <div class="row">

                <div class="col-xl-9 col-xl-push-3 col-lg-8 col-lg-push-4 col-md-8 col-md-push-4 text-page">

                    <header class="woocommerce-products-header"></header>
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="bootstrap-iso">
                        @if(Session::has('success'))
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                                    <div id="charge-message" class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-6 float-left" >
                                <p class="woocommerce-result-count" style="color: #112C91"> Showing all 2 results</p>
                            </div>
                            <div class="col-sm-12 col-md-6 float-right" >
                                <form class="woocommerce-ordering" method="get" style="height: 50px; padding: 1rem 1rem 2.5rem;">
                                <select name="orderby" class="orderby" style="margin: -1rem; ">
                                    <option value="menu_order" selected='selected'>Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                                <input type="hidden" name="paged" value="1" />
                            </form>
                            </div>
                        </div>
                    </div>


                    <ul class="products columns-4">
                        <div class="bootstrap-iso">
                            <div class="row">
                                @foreach($bottles as $product)
                                <div class="col-sm-6 col-md-6" style="margin-left: -1rem; margin-right:1rem">
                                    <div class="thumbnail">
                                        <img src="{{asset('images/backends_images/products/'.$product->image)}}" alt="...">
                                        <div class="caption text-center">
                                            <h3 class="prod_title">{{$product->case}}</h3>
                                            <span class="price text-center" >&#8358 {{$product->price}}</span>
                                            <p class="text-center"><a href="{{route('product.addToCart', ['id'=>$product->id])}}" class="btn btn-primary round" role="button"><i class="fa fa-cart-plus"></i> Add to Cart</a> </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </ul>

                </div>
                <div class="col-xl-3 col-lg-4 col-md-4 col-xl-pull-9 col-lg-pull-8 col-md-pull-8">
                    <div id="content-sidebar" class="content-sidebar woocommerce-sidebar widget-area" role="complementary">
                        <aside id="woocommerce_widget_cart-4" class="widget woocommerce widget_shopping_cart">
                            <h3 class="header-widget">Cart</h3>
                            <div class=" bootstrap-iso"  style="background-color: #F1F6FB">
                                @if(Session::has('cart') && !empty($items))
                                    @foreach($items as $item)
                                        <div class="row" >
                                            <div class="col-sm-3">
                                                <a href="" id="delete_cart" >&times;</a>
                                                 <img src="{{asset('images/backends_images/products/'.$item['item']->image)}}" alt="">
                                            </div>
                                            <div class="col-sm-9">
                                                <h4 id="item_title">{{$item['item']->case}}</h4>
                                                <h4 id="item_price"> <span class="prod_title" style="font-size: 18px">{{$item['qty']}} </span>   &times; &#8358 {{number_format($item['item']->price, 2)}}</h4>
                                            </div>
                                        </div>
                                        <br >
                                    @endforeach
                                        <hr class="my-1" style="margin-top: 0; margin-bottom: 2px; border: 0.1px solid lightgrey">
                                        <hr class="my-1" style="margin-top: 1px; margin-bottom: 1rem; border: 0.1px solid lightgrey">

                                        <div class="btn-cart-footer text-center">
                                            <span class="prod_title" >Subtotal: &#8358 {{number_format($total_price,2)}}</span>
                                            <a href="{{route('cart')}}" class="btn btn-primary btn-block" id="view_cart" style=" border-radius: 1rem;">View Cart</a>
                                        </div>
                                        <div class="btn-cart-footer text-center">
                                            <a href="" class="btn btn-info btn-block" id="checkout" style=" border-radius: 1rem;">Checkout</a>
                                        </div>



                                @endif

                            </div>
                        </aside>
                        <aside id="woocommerce_product_categories-4" class="widget woocommerce widget_product_categories">
                            <h3 class="header-widget">Categories</h3>
                            <ul class="product-categories">
                                <li class="cat-item cat-item-207"><a href="">Uncategorized</a></li>
                                <li class="cat-item cat-item-190"><a href="">Water</a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')





@endpush
