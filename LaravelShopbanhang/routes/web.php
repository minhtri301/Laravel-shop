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
//Send Mail
Route::get('/send-mail','HomeController@send_mail');

//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//login gg
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

//login dangnhap
Route::get('/login','Checklogin@login');
Route::post('/login-layout','Checklogin@login_layout');
Route::post('/login-dangky','Checklogin@login_dangky');

//Frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/demo','HomeController@layout');
Route::post('/tim-kiem','HomeController@search');


//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{slug_brand_product}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{slug_product}','ProductController@details_product');
Route::get('/danh-muc-san-pham','ProductController@danh_muc_san_pham');




//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');


//category product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//Brand product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');


//cart

Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/gio-hang','CartController@gio_hang');	
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/del-product/{session_id}','CartController@del_product');//ajax
Route::get('/del-all-product','CartController@del_all_product');//ajax
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');//ajax


//Coupon
Route::post('/check-coupon','CartController@check_coupon');//ajax
Route::get('/insert-coupon','CouponController@insert_coupon');//ajax
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');//ajax
Route::get('/list-coupon','CouponController@list_coupon');//ajax
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');//ajax
Route::get('/unset-coupon','CouponController@unset_coupon');//ajax



//add-cart-ajax
Route::post('/add-cart-ajax','CartController@add_cart_ajax');


//checkout

Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/select-delivery-cart','CheckoutController@select_delivery_cart');
Route::post('calculate-fee','CheckoutController@calculate_fee');
Route::get('del-fee','CheckoutController@del_fee');
Route::post('confirm-order','CheckoutController@confirm_order');

//order Admin
Route::get('manage-order','OrderController@manage_order');
Route::get('view-order/{order_code}','OrderController@view_order');
Route::get('print-order/{checkout_code}','OrderController@print_order');
Route::post('/update-detail-order','OrderController@update_detail_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::get('delete-order/{order_code}','OrderController@delete_order');

// Route::get('/manage-order','CheckoutController@manage_order');
// Route::get('/view-order/{orderId}','CheckoutController@view_order');

//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');







// Route::get('/trang-chu', function () {
//     return view('layout');
// });
