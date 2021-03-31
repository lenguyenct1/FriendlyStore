<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend 
Route::get('/','HomeController@index' );
Route::get('/home','HomeController@index');
Route::post('/search','HomeController@search');
Route::get('/product','HomeController@all_product');
Route::get('/contact','HomeController@getcontact');
Route::get('/show-news','HomeController@show_news');
Route::get('/show-promotion','HomeController@show_promotion');
//Danh muc san pham trang chu
Route::get('/show-category-home/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('/show-brand-home/{brand_slug}','BrandProduct@show_brand_home');
Route::get('/details-product-home/{product_slug}','ProductController@details_product');
Route::get('/show-details-news/{news_slug}','NewsController@show_details_news');
//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');


Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/inventory-management','ProductController@inventory_management');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/update-number/{product_id}','ProductController@update_number');
//News
Route::get('/add-news','NewsController@add_news');
Route::get('/edit-news/{news_id}','NewsController@edit_news');
Route::get('/delete-news/{news_id}','NewsController@delete_news');
Route::get('/all-news','NewsController@all_news');

Route::get('/unactive-news/{news_id}','NewsController@unactive_news');
Route::get('/active-news/{news_id}','NewsController@active_news');

Route::post('/save-news','NewsController@save_news');
Route::post('/update-news/{news_id}','NewsController@update_news');

//Cart
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/save-cart/{product_slug}','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');



//Order
//Route::get('/manage-order','CheckoutController@manage_order');
//Route::get('/view-order/{orderId}','CheckoutController@view_order');
//Statistical
Route::get('/statistical-number-of-product','StatisticalController@statistical_number_of_product');
Route::get('/revenue-statistics','StatisticalController@revenue_statistics');
Route::get('/revenue-statistics-months','StatisticalController@revenue_statistics_month');
Route::get('/revenue-statistics-5-years','StatisticalController@revenue_statistics_5_years');


//Coupon
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/edit-coupon/{coupon_id}','CouponController@edit_coupon');
Route::post('/update-coupon/{coupon_id}','CouponController@update_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');


//Checkout


Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/del-fee','CheckoutController@del_fee');

Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::get('/order-place','CheckoutController@order_place');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/confirm-order','CheckoutController@confirm_order');
Route::get('/purchase-history','CheckoutController@purchase_history');
Route::get('/purchase-history-detail/{order_code}','CheckoutController@purchase_history_detail');
Route::post('/cancel-order','CheckoutController@cancel_order');
//Order

Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/order-status-product/{order_code}','OrderController@order_status_product');
Route::post('/complete-the-order/{order_code}','OrderController@complete_the_order');

//Category 
Route::get('/add-category','CategoryController@add_category');
Route::get('/edit-category/{id}','CategoryController@edit_category');
Route::get('/delete-category/{id}','CategoryController@delete_category');
Route::get('/all-category','CategoryController@all_category');

Route::get('/unactive-category/{id}','CategoryController@unactive_category');
Route::get('/active-category/{id}','CategoryController@active_category');


Route::post('/save-category','CategoryController@save_category');
Route::post('/update-category/{id}','CategoryController@update_category');
Route::post('/get-category','CategoryController@get_category');
//Producer
Route::get('/add-producer','ProducerController@add_producer');
Route::get('/edit-producer/{producer_id}','ProducerController@edit_producer');
Route::get('/delete-producer/{producer_id}','ProducerController@delete_producer');
Route::get('/all-producer','ProducerController@all_producer');
Route::post('/save-producer','ProducerController@save_producer');
Route::post('/update-producer/{producer_id}','ProducerController@update_producer');

//Origin
Route::get('/add-origin','OriginController@add_origin');
Route::get('/edit-origin/{product_origin_id}','OriginController@edit_origin');
Route::get('/delete-origin/{product_origin_id}','OriginController@delete_origin');
Route::get('/all-origin','OriginController@all_origin');
Route::post('/save-origin','OriginController@save_origin');
Route::post('/update-origin/{product_origin_id}','OriginController@update_origin');

//SLider
Route::get('/all-slider','SliderController@all_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/edit-slider/{slider_id}','SliderController@edit_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');
Route::post('/save-slider','SliderController@save_slider');
Route::post('/update-slider/{slider_id}','SliderController@update_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');