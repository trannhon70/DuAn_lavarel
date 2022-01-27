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
//front end
Route::get('/','HomeController@index');
Route::get('/trang-chu', 'HomeController@index');

//Tìm kiếm sản phẩm 
Route::post('/tim-kiem', 'HomeController@tim_kiem');

//Danh mục sản phẩm trang chủ 
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');

//Thương hiệu sản phẩm trên trang chủ 
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProduct@show_brand_home');

//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product');


//Back end

Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');

//Đăng xuất
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dashboard', 'AdminController@dashboard');

//Thêm và hiển thị danh mục Category_product
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');

//sửa danh mục 
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
//Xóa danh mục
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
//update danh mục
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

//lấy id của danh mục
Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');


Route::post('/save-category-product', 'CategoryProduct@save_category_product');


//Thêm và hiển thị thương hiệu Brand_product
Route::get('/add-brand-product', 'BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'BrandProduct@all_brand_product');

//sửa thương hiệu
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
//Xóa thương hiệu
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');
//update thương hiệu
Route::post('/update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');

//lấy id của thương hiệu
Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProduct@active_brand_product');


Route::post('/save-brand-product', 'BrandProduct@save_brand_product');


//Thêm và hiển thị sản phẩm product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');

//sửa sản phẩm
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
//Xóa sản phẩm
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
//update sản phẩm
Route::post('/update-product/{product_id}', 'ProductController@update_product');

//lấy id của sản phẩm
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

//thêm sản phẩm
Route::post('/save-product', 'ProductController@save_product');

//Giỏ hàng
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
//xóa sản phẩm trong đơn hàng
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');
//update số lượng sản phẩm trong giỏ hàng
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');

//checkout & thanh toán
Route::get('/login-checkout/', 'CheckoutController@login_checkout');
//xử lý đăng ký tài khoản
Route::post('/add-customer/', 'CheckoutController@add_customer');

//xử lý đăng nhập người dùng 
Route::post('/login-customer/', 'CheckoutController@login_customer');
//xử lý đăng xuất người dùng 
Route::get('/logout-checkout/', 'CheckoutController@logout_checkout');
//thanh toán
Route::get('/checkout/', 'CheckoutController@checkout');
Route::get('/payment/', 'CheckoutController@payment');
Route::post('/order-place', 'CheckoutController@order_place');

//thực hiện insert dữ liệu khách hàng 
Route::post('/save-checkout-customer/', 'CheckoutController@save_checkout_customer');

//xem đơn hàng 
Route::get('/manage-order/', 'CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'CheckoutController@view_order');