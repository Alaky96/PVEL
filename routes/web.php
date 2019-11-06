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

//Test for email
Route::get('email', function(){
    $order = App\PurchaseOrders::find(33);

    return new App\Mail\OrderConfirmation($order);
});

