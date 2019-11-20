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

//Index
Route::get('/', function () {
    return view('index');
});
Route::get('/home', 'HomeController@index')->name('home');

//about
Route::get("/about", 'HomeController@about')->name('about');


//Auth
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


//Profile
Route::get('/profile', 'ProfileController@edit');
Route::post('/profile', 'ProfileController@update')->name('profile');


//Languages
Route::get('locale/{locale}', function ($locale) {
    session(['userLocale' => $locale]);
    return redirect()->back();
});

//Products
Route::resource('/supplier/product', 'ProductController')->middleware("validatesupplier");

//Customer Product
Route::get('/customer/product/{id}', 'CustomerProductController@show')->name("customer.product");
Route::post('/customer/askquestion', 'CustomerProductController@askQuestion')->name('askQuestion');
route::post("/customer/product/comment", "CustomerProductController@storeComment")->name("comment.store");
Route::get("/customer/product/comment/delete/{id}", "CustomerProductController@deleteComment")->name("comment.delete")->middleware("validateadmin");

//Cart
Route::post("/cart/addItem", "CartController@addItem")->name("cart.addItem");
Route::get("/cart", "CartController@show")->name("cart.show");
Route::get("/cart/delete/{id}", "CartController@delete");
Route::get("/cart/payment", "PaymentController@payWithpaypal")->name("paywithpaypal");
Route::get("/cart/payment/execute", "PaymentController@getPaymentStatus")->name("executepayment");
Route::get("/cart/checkout", "CartController@checkout")->name("checkout");
Route::post("/cart/checkout", "PaymentController@checkout")->name("chargecheckout");
Route::get("/cart/payment/confirm/{ans}/{id}/{method}/{po}", "PaymentController@confirm")->name("confirm");
Route::get("/cart/payment/review/{po?}/{id?}/{method?}", "PaymentController@review")->name("review");

//Order
Route::get("/customer/order", "OrderController@index")->name("customerOrder.index");
Route::get("/customer/order/track/{id}", "OrderController@track")->name("customerOrder.track");

//Shipments
Route::resource('shipments', 'ShipmentController')->only([
    'index', 'edit', 'update'
]);

//Admin
Route::get("/admin/users", "AdminController@showUsers")->name("admin.users");
Route::post("/admin/users/{id}", "AdminController@editUser")->name("admin.editUser");
Route::get("/admin/users/destroy/{id}", "AdminController@deleteUser")->name("admin.deleteUser");
Route::get("/admin/products", "AdminController@showProducts")->name("admin.products");

//Customer products nav
route::get("/customer/products/supplier/{supplier}", "CustomerProductController@supplier")->name("customer.products.supplier");
route::get("/customer/products/{category?}/{supplier?}", "CustomerProductController@index")->name("customer.products");
route::post("/customer/products/ajax/getProducts", "CustomerProductController@getProducts");

//Support
route::get("/support", function(){return view("support");})->name("support")->middleware("auth")->middleware("multilanguages");

