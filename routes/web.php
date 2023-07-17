<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

$ctrl = '\App\Http\Controllers';

Route::get('admin',$ctrl.'\LoginController@view_admin')->name('login-admin');
Route::get('login-admin',$ctrl.'\LoginController@view_admin')->name('login-admin');
Route::get('login',$ctrl.'\LoginController@view')->name('login');
// Route::get('register-admin',$ctrl.'\RegisterController@view_admin')->name('register');
Route::get('register',$ctrl.'\RegisterController@view')->name('register');
Route::post('login',$ctrl.'\LoginController@authenticate')->name('login.auth');
Route::post('login-admin',$ctrl.'\LoginController@authenticate_admin')->name('login.admin');
Route::post('register',$ctrl.'\RegisterController@register')->name('register.register');
Route::post('register-admin',$ctrl.'\RegisterController@register_admin')->name('register.admin');

// Route::get('/', function() {
//     return redirect()->intended('dashboard');
// })->name('dashboard');


Route::get('/',$ctrl.'\DashboardController@view')->name('dashboard');
Route::post('logout',$ctrl.'\LoginController@logout')->name('logout');
Route::get('product-detail/{id}',$ctrl.'\ProductController@detailProduct')->name('product-detail');

// admin

Route::middleware('auth')->get('store',$ctrl.'\StoreController@index')->name('store.index');
Route::middleware('auth')->post('store',$ctrl.'\StoreController@store')->name('store.store');
Route::middleware('auth')->get('store/create',$ctrl.'\StoreController@create')->name('store.create');
Route::middleware('auth')->put('store/{id}',$ctrl.'\StoreController@update')->name('store.update');
Route::middleware('auth')->delete('store/{id}',$ctrl.'\StoreController@destroy')->name('store.destroy');
Route::middleware('auth')->get('store/{id}',$ctrl.'\StoreController@edit')->name('store.edit');

Route::middleware('auth')->get('category',$ctrl.'\CategoryController@index')->name('category.index');
Route::middleware('auth')->post('category',$ctrl.'\CategoryController@store')->name('category.store');
Route::middleware('auth')->get('category/create',$ctrl.'\CategoryController@create')->name('category.create');
Route::middleware('auth')->put('category/{id}',$ctrl.'\CategoryController@update')->name('category.update');
Route::middleware('auth')->delete('category/{id}',$ctrl.'\CategoryController@destroy')->name('category.destroy');
Route::middleware('auth')->get('category/{id}',$ctrl.'\CategoryController@edit')->name('category.edit');

Route::middleware('auth')->get('product',$ctrl.'\ProductController@index')->name('product.index');
Route::middleware('auth')->post('product',$ctrl.'\ProductController@store')->name('product.store');
Route::middleware('auth')->get('product/create',$ctrl.'\ProductController@create')->name('product.create');
Route::middleware('auth')->get('product/{id}',$ctrl.'\ProductController@edit')->name('product.edit');
Route::middleware('auth')->put('product/{id}',$ctrl.'\ProductController@update')->name('product.update');
Route::middleware('auth')->delete('product/{id}',$ctrl.'\ProductController@destroy')->name('product.destroy');

Route::middleware('auth')->get('payment',$ctrl.'\PaymentController@index')->name('payment.index');
Route::middleware('auth')->post('payment',$ctrl.'\PaymentController@store')->name('payment.store');
Route::middleware('auth')->get('payment/create',$ctrl.'\PaymentController@create')->name('payment.create');
Route::middleware('auth')->put('payment/{id}',$ctrl.'\PaymentController@update')->name('payment.update');
Route::middleware('auth')->delete('payment/{id}',$ctrl.'\PaymentController@destroy')->name('payment.destroy');
Route::middleware('auth')->get('payment/{id}',$ctrl.'\PaymentController@edit')->name('payment.edit');

Route::middleware('auth')->get('role',$ctrl.'\RoleController@index')->name('role.index');
Route::middleware('auth')->post('role',$ctrl.'\RoleController@store')->name('role.store');
Route::middleware('auth')->get('role/create',$ctrl.'\RoleController@create')->name('role.create');
Route::middleware('auth')->put('role/{id}',$ctrl.'\RoleController@update')->name('role.update');
Route::middleware('auth')->delete('role/{id}',$ctrl.'\RoleController@destroy')->name('role.destroy');
Route::middleware('auth')->get('role/{id}',$ctrl.'\RoleController@edit')->name('role.edit');

Route::middleware('auth')->get('transaction-status',$ctrl.'\TransactionStatusController@index')->name('transaction-status.index');

Route::middleware('auth')->get('transaction-type',$ctrl.'\TransactionTypeController@index')->name('transaction-type.index');

Route::middleware('auth')->get('cutting',$ctrl.'\CuttingController@index')->name('cutting.index');
Route::middleware('auth')->post('cutting',$ctrl.'\CuttingController@store')->name('cutting.store');
Route::middleware('auth')->get('cutting/create',$ctrl.'\CuttingController@create')->name('cutting.create');
Route::middleware('auth')->put('cutting/{id}',$ctrl.'\CuttingController@update')->name('cutting.update');
Route::middleware('auth')->delete('cutting/{id}',$ctrl.'\CuttingController@destroy')->name('cutting.destroy');
Route::middleware('auth')->get('cutting/{id}',$ctrl.'\CuttingController@edit')->name('cutting.edit');

Route::middleware('auth')->get('finishing',$ctrl.'\FinishingController@index')->name('finishing.index');
Route::middleware('auth')->post('finishing',$ctrl.'\FinishingController@store')->name('finishing.store');
Route::middleware('auth')->get('finishing/create',$ctrl.'\FinishingController@create')->name('finishing.create');
Route::middleware('auth')->put('finishing/{id}',$ctrl.'\FinishingController@update')->name('finishing.update');
Route::middleware('auth')->delete('finishing/{id}',$ctrl.'\FinishingController@destroy')->name('finishing.destroy');
Route::middleware('auth')->get('finishing/{id}',$ctrl.'\FinishingController@edit')->name('finishing.edit');

Route::middleware('auth')->get('user',$ctrl.'\UserController@index')->name('user.index');
Route::middleware('auth')->post('user',$ctrl.'\UserController@store')->name('user.store');
Route::middleware('auth')->get('user/create',$ctrl.'\UserController@create')->name('user.create');
Route::middleware('auth')->put('user/{id}',$ctrl.'\UserController@update')->name('user.update');
Route::middleware('auth')->delete('user/{id}',$ctrl.'\UserController@destroy')->name('user.destroy');
Route::middleware('auth')->get('user/{id}',$ctrl.'\UserController@edit')->name('user.edit');

Route::middleware('auth')->get('transaction', $ctrl . '\TransactionController@index')->name('transaction.index');
Route::middleware('auth')->get('transaction-pending', $ctrl . '\TransactionController@indexPending')->name('transaction.index.pending');
Route::middleware('auth')->get('transaction-menunggu-konfirmasi', $ctrl . '\TransactionController@indexMenungguKonfirmasi')->name('transaction.index.menunggu.konfirmasi');
Route::middleware('auth')->get('transaction-approved', $ctrl . '\TransactionController@indexApproved')->name('transaction.index.approved');
Route::middleware('auth')->get('transaction-diproses', $ctrl . '\TransactionController@indexDiproses')->name('transaction.index.diproses');
Route::middleware('auth')->get('transaction-dikirim', $ctrl . '\TransactionController@indexDikirim')->name('transaction.index.dikirim');
Route::middleware('auth')->get('transaction-selesai', $ctrl . '\TransactionController@indexSelesai')->name('transaction.index.selesai');
Route::middleware('auth')->get('transaction-batal', $ctrl . '\TransactionController@indexBatal')->name('transaction.index.batal');

Route::middleware('auth')->post('transaction',$ctrl.'\TransactionController@store')->name('transaction.store');
Route::middleware('auth')->get('transaction/create',$ctrl.'\TransactionController@create')->name('transaction.create');
Route::middleware('auth')->get('transaction/product-list',$ctrl.'\ProductController@productListAdmin')->name('product-list-admin');
Route::middleware('auth')->get('transaction-product/create/{id}',$ctrl.'\TransactionController@createProductList')->name('transaction.product.create');
Route::middleware('auth')->get('transaction-product/delete/{id}',$ctrl.'\TransactionController@destroyProductList')->name('transaction.product.destroy');
Route::middleware('auth')->get('transaction-product/edit/{id}',$ctrl.'\TransactionController@editProductList')->name('transaction.product.edit');
Route::middleware('auth')->post('transaction-product',$ctrl.'\TransactionController@storeProductList')->name('transaction.product.store');
Route::middleware('auth')->put('transaction-product/{id}',$ctrl.'\TransactionController@updateProductList')->name('transaction.product.update');
Route::middleware('auth')->put('transaction/{id}',$ctrl.'\TransactionController@update')->name('transaction.update');
Route::middleware('auth')->delete('transaction/{id}',$ctrl.'\TransactionController@destroy')->name('transaction.destroy');
Route::middleware('auth')->get('transaction/detail/{id}',$ctrl.'\TransactionController@detail')->name('transaction.detail');
Route::middleware('auth')->get('transaction/payment/{id}',$ctrl.'\TransactionController@pembayaran')->name('transaction.pembayaran');
Route::middleware('auth')->get('transaction/{id}',$ctrl.'\TransactionController@edit')->name('transaction.edit');
Route::middleware('auth')->post('transaction/update-transaction-status/{id}',$ctrl.'\TransactionController@updateTransactionStatus')->name('transaction.update.transaction.status');
Route::middleware('auth')->post('transaction/update-payment-status/{id}',$ctrl.'\TransactionController@updatePaymentStatus')->name('transaction.update.payment.status');
Route::middleware('auth')->get('admin/cart/create/{id}',$ctrl.'\CartController@admin_cart_create')->name('admin.cart.create');
Route::middleware('auth')->post('admin/cart',$ctrl.'\CartController@admin_cart_store')->name('admin.cart.store');
Route::middleware('auth')->get('admin/cart/delete/{id}',$ctrl.'\CartController@admin_cart_destroy')->name('admin.cart.destroy');
Route::middleware('auth')->get('admin/cart/edit/{id}',$ctrl.'\CartController@admin_cart_edit')->name('admin.cart.edit');
Route::middleware('auth')->put('admin/cart/update/{id}',$ctrl.'\CartController@admin_cart_update')->name('admin.cart.update');

Route::get('download',$ctrl.'\ImageController@downloadFile')->name('download');

Route::middleware('auth')->get('profile',$ctrl.'\ProfileController@index')->name('profile.index');
Route::middleware('auth')->put('profile/{id}',$ctrl.'\ProfileController@update')->name('profile.update');

Route::middleware('auth')->get('report-transaction',$ctrl.'\ReportController@reportTransaction')->name('report.reportTransaction');
Route::middleware('auth')->get('report-stock-product',$ctrl.'\ReportController@reportStockProduct')->name('report.reportStockProduct');

Route::middleware('auth')->get('image/{file}',$ctrl.'\ImageController@image')->name('image');

Route::middleware('auth')->get('print-struk',$ctrl.'\PrintController@printStruk')->name('print.struk');
Route::get('print-pdf/{id}',$ctrl.'\PrintController@printPDF')->name('print.pdf');


Route::middleware('auth')->get('customer',$ctrl.'\CustomerController@index')->name('customer.index');
Route::middleware('auth')->post('customer',$ctrl.'\CustomerController@store')->name('customer.store');
Route::middleware('auth')->get('customer/create',$ctrl.'\CustomerController@create')->name('customer.create');
Route::middleware('auth')->put('customer/{id}',$ctrl.'\CustomerController@update')->name('customer.update');
Route::middleware('auth')->delete('customer/{id}',$ctrl.'\CustomerController@destroy')->name('customer.destroy');
Route::middleware('auth')->get('customer/{id}',$ctrl.'\CustomerController@edit')->name('customer.edit');

Route::middleware('auth')->get('banner',$ctrl.'\BannerController@index')->name('banner.index');
Route::middleware('auth')->post('banner',$ctrl.'\BannerController@store')->name('banner.store');
Route::middleware('auth')->get('banner/create',$ctrl.'\BannerController@create')->name('banner.create');
Route::middleware('auth')->get('banner/{id}',$ctrl.'\BannerController@edit')->name('banner.edit');
Route::middleware('auth')->put('banner/{id}',$ctrl.'\BannerController@update')->name('banner.update');
Route::middleware('auth')->delete('banner/{id}',$ctrl.'\BannerController@destroy')->name('banner.destroy');


// customer


Route::middleware('auth:customer')->get('profile-customer',$ctrl.'\ProfileController@profile_customer')->name('profile-customer.index');
Route::middleware('auth:customer')->put('profile-customer/{id}',$ctrl.'\ProfileController@update_profile_customer')->name('profile-customer.update');
Route::get('product-list',$ctrl.'\ProductController@productList')->name('product-list');
Route::middleware('auth:customer')->get('add-to-cart/{id}',$ctrl.'\CartController@addToCart')->name('add.to.cart');
Route::middleware('auth:customer')->get('cart-list',$ctrl.'\CartController@cartListCustomer')->name('cart.list');
Route::middleware('auth:customer')->post('cart-payment',$ctrl.'\CartController@cartPaymentCustomer')->name('cart.payment');
Route::middleware('auth:customer')->put('update-cart/{id}',$ctrl.'\CartController@updatePelanggan')->name('cart.list.update');

Route::get('cart/create/{id}',$ctrl.'\CartController@create')->name('cart.create');
Route::middleware('auth:customer')->post('cart',$ctrl.'\CartController@store')->name('cart.store');
Route::middleware('auth:customer')->get('cart/delete/{id}',$ctrl.'\CartController@destroy')->name('cart.destroy');
Route::middleware('auth:customer')->get('cart/edit/{id}',$ctrl.'\CartController@edit')->name('cart.edit');
Route::middleware('auth:customer')->put('cart/update/{id}',$ctrl.'\CartController@update')->name('cart.update');


Route::middleware('auth:customer')->get('transaction-customer', $ctrl . '\TransactionController@indexTransactionCustomer')->name('transaction.customer.index');
Route::middleware('auth:customer')->post('transaction-customer',$ctrl.'\TransactionController@storeTransactionCustomer')->name('transaction.customer.store');
Route::middleware('auth:customer')->get('transaction-customer/create',$ctrl.'\TransactionController@create')->name('transaction.customer.create');
Route::middleware('auth:customer')->get('transaction-customer-product/create/{id}',$ctrl.'\TransactionController@createProductList')->name('transaction.customer.product.create');
Route::middleware('auth:customer')->get('transaction-customer-product/delete/{id}',$ctrl.'\TransactionController@destroyProductList')->name('transaction.customer.product.destroy');
Route::middleware('auth:customer')->get('transaction-customer-product/edit/{id}',$ctrl.'\TransactionController@editProductList')->name('transaction.customer.product.edit');
Route::middleware('auth:customer')->post('transaction-customer-product',$ctrl.'\TransactionController@storeProductList')->name('transaction.customer.product.store');
Route::middleware('auth:customer')->put('transaction-customer-product/{id}',$ctrl.'\TransactionController@updateProductList')->name('transaction.customer.product.update');
Route::middleware('auth:customer')->put('transaction-customer/{id}',$ctrl.'\TransactionController@update')->name('transaction.customer.update');
Route::middleware('auth:customer')->delete('transaction-customer/{id}',$ctrl.'\TransactionController@destroy')->name('transaction.customer.destroy');
Route::middleware('auth:customer')->get('transaction-customer/detail/{id}',$ctrl.'\TransactionController@detailTransactionCustomer')->name('transaction.customer.detail');
Route::middleware('auth:customer')->get('transaction-customer/payment/{id}',$ctrl.'\TransactionController@pembayaran')->name('transaction.customer.pembayaran');
Route::middleware('auth:customer')->put('transaction-customer/payment/{id}',$ctrl.'\TransactionController@updatePembayaran')->name('transaction.customer.update.pembayaran');
Route::middleware('auth:customer')->get('transaction-customer/{id}',$ctrl.'\TransactionController@edit')->name('transaction.customer.edit');

Route::middleware('auth:customer')->get('address',$ctrl.'\AddressController@index')->name('customer.address');
Route::middleware('auth:customer')->get('address-create',$ctrl.'\AddressController@create')->name('customer.address.create');
Route::middleware('auth:customer')->post('address',$ctrl.'\AddressController@store')->name('customer.address.store');
Route::middleware('auth:customer')->get('address/{id}',$ctrl.'\AddressController@edit')->name('customer.address.edit');
Route::middleware('auth:customer')->put('address/{id}',$ctrl.'\AddressController@update')->name('customer.address.update');
Route::middleware('auth:customer')->delete('address/{id}',$ctrl.'\AddressController@destroy')->name('customer.address.destroy');

Route::get('/get-couriers',$ctrl.'\AddressController@getCouriers');
Route::get('/get-provinces',$ctrl.'\AddressController@getProvinces');
Route::get('/get-regencies/{provinceId}',$ctrl.'\AddressController@getRegencies');
Route::get('/get-districts/{regencyId}',$ctrl.'\AddressController@getDistricts');
Route::get('/get-villages/{districtId}',$ctrl.'\AddressController@getVillages');

