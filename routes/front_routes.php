<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('home');

Route::get('/about-us', 'IndexController@about_us')->name('about');
Route::get('/faq', 'IndexController@faq')->name('faq');

Route::get('/shop', 'ProductsController@shop')->name('shop');
Route::get('/add-to-cart/{id}', 'ProductsController@getAddToCart')->name('product.addToCart');
Route::get('/add-more-cart/{id}/{qty}', 'ProductsController@moreToCart')->name('moreToCart');
Route::get('/cart', 'ProductsController@showCart')->name('cart');

/*====================== Post For Applying coupon Route==================================*/
Route::post('/cart/apply-coupon','ProductsController@applyCoupon')->name('apply.coupon');

/*====================== Checkout Route==================================*/
Route::match(['get','post'],'/checkout','ProductsController@checkout')->name('checkout');
Route::match(['get','post'],'/user-login','ProductsController@login')->name('user.login');
Route::match(['get','post'],'/order-thanks','ProductsController@orderThanks')->name('order.thanks');
