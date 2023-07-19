<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StoreController;
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
Route::post('logout-admin',$ctrl.'\LoginController@logoutAdmin')->name('logout-admin');
Route::get('product-detail/{id}',$ctrl.'\ProductController@detailProduct')->name('product-detail');

// admin
Route::middleware('auth')->group(function () {
    // Rute-rute di sini akan menggunakan middleware grup "auth" untuk admin
    $ctrl = '\App\Http\Controllers';
    Route::get('store',[StoreController::class, 'index'])->name('store.index');
    Route::post('store',$ctrl.'\StoreController@store')->name('store.store');
    Route::get('store/create',$ctrl.'\StoreController@create')->name('store.create');
    Route::put('store/{id}',$ctrl.'\StoreController@update')->name('store.update');
    Route::delete('store/{id}',$ctrl.'\StoreController@destroy')->name('store.destroy');
    Route::get('store/{id}',$ctrl.'\StoreController@edit')->name('store.edit');
    
    Route::get('category',$ctrl.'\CategoryController@index')->name('category.index');
    Route::post('category',$ctrl.'\CategoryController@store')->name('category.store');
    Route::get('category/create',$ctrl.'\CategoryController@create')->name('category.create');
    Route::put('category/{id}',$ctrl.'\CategoryController@update')->name('category.update');
    Route::delete('category/{id}',$ctrl.'\CategoryController@destroy')->name('category.destroy');
    Route::get('category/{id}',$ctrl.'\CategoryController@edit')->name('category.edit');
    
    Route::get('product',$ctrl.'\ProductController@index')->name('product.index');
    Route::post('product',$ctrl.'\ProductController@store')->name('product.store');
    Route::get('product/create',$ctrl.'\ProductController@create')->name('product.create');
    Route::get('product/{id}',$ctrl.'\ProductController@edit')->name('product.edit');
    Route::put('product/{id}',$ctrl.'\ProductController@update')->name('product.update');
    Route::delete('product/{id}',$ctrl.'\ProductController@destroy')->name('product.destroy');
    
    Route::get('payment',$ctrl.'\PaymentController@index')->name('payment.index');
    Route::post('payment',$ctrl.'\PaymentController@store')->name('payment.store');
    Route::get('payment/create',$ctrl.'\PaymentController@create')->name('payment.create');
    Route::put('payment/{id}',$ctrl.'\PaymentController@update')->name('payment.update');
    Route::delete('payment/{id}',$ctrl.'\PaymentController@destroy')->name('payment.destroy');
    Route::get('payment/{id}',$ctrl.'\PaymentController@edit')->name('payment.edit');
    
    Route::get('role',$ctrl.'\RoleController@index')->name('role.index');
    Route::post('role',$ctrl.'\RoleController@store')->name('role.store');
    Route::get('role/create',$ctrl.'\RoleController@create')->name('role.create');
    Route::put('role/{id}',$ctrl.'\RoleController@update')->name('role.update');
    Route::delete('role/{id}',$ctrl.'\RoleController@destroy')->name('role.destroy');
    Route::get('role/{id}',$ctrl.'\RoleController@edit')->name('role.edit');
    
    Route::get('transaction-status',$ctrl.'\TransactionStatusController@index')->name('transaction-status.index');
    
    Route::get('transaction-type',$ctrl.'\TransactionTypeController@index')->name('transaction-type.index');
    
    Route::get('cutting',$ctrl.'\CuttingController@index')->name('cutting.index');
    Route::post('cutting',$ctrl.'\CuttingController@store')->name('cutting.store');
    Route::get('cutting/create',$ctrl.'\CuttingController@create')->name('cutting.create');
    Route::put('cutting/{id}',$ctrl.'\CuttingController@update')->name('cutting.update');
    Route::delete('cutting/{id}',$ctrl.'\CuttingController@destroy')->name('cutting.destroy');
    Route::get('cutting/{id}',$ctrl.'\CuttingController@edit')->name('cutting.edit');
    
    Route::get('finishing',$ctrl.'\FinishingController@index')->name('finishing.index');
    Route::post('finishing',$ctrl.'\FinishingController@store')->name('finishing.store');
    Route::get('finishing/create',$ctrl.'\FinishingController@create')->name('finishing.create');
    Route::put('finishing/{id}',$ctrl.'\FinishingController@update')->name('finishing.update');
    Route::delete('finishing/{id}',$ctrl.'\FinishingController@destroy')->name('finishing.destroy');
    Route::get('finishing/{id}',$ctrl.'\FinishingController@edit')->name('finishing.edit');
    
    Route::get('user',$ctrl.'\UserController@index')->name('user.index');
    Route::post('user',$ctrl.'\UserController@store')->name('user.store');
    Route::get('user/create',$ctrl.'\UserController@create')->name('user.create');
    Route::put('user/{id}',$ctrl.'\UserController@update')->name('user.update');
    Route::delete('user/{id}',$ctrl.'\UserController@destroy')->name('user.destroy');
    Route::get('user/{id}',$ctrl.'\UserController@edit')->name('user.edit');
    
    Route::get('transaction',[ TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transaction-pending', $ctrl . '\TransactionController@indexPending')->name('transaction.index.pending');
    Route::get('transaction-menunggu-konfirmasi', $ctrl . '\TransactionController@indexMenungguKonfirmasi')->name('transaction.index.menunggu.konfirmasi');
    Route::get('transaction-approved', $ctrl . '\TransactionController@indexApproved')->name('transaction.index.approved');
    Route::get('transaction-diproses', $ctrl . '\TransactionController@indexDiproses')->name('transaction.index.diproses');
    Route::get('transaction-dikirim', $ctrl . '\TransactionController@indexDikirim')->name('transaction.index.dikirim');
    Route::get('transaction-selesai', $ctrl . '\TransactionController@indexSelesai')->name('transaction.index.selesai');
    Route::get('transaction-batal', $ctrl . '\TransactionController@indexBatal')->name('transaction.index.batal');
    
    Route::post('transaction',[TransactionController::class,'store'])->name('transaction.store');
    Route::get('transaction/create',[TransactionController::class,'create'])->name('transaction.create');
    Route::get('transaction/product-list',$ctrl.'\ProductController@productListAdmin')->name('product-list-admin');
    Route::get('transaction-product/create/{id}',$ctrl.'\TransactionController@createProductList')->name('transaction.product.create');
    Route::get('transaction-product/delete/{id}',$ctrl.'\TransactionController@destroyProductList')->name('transaction.product.destroy');
    Route::get('transaction-product/edit/{id}',$ctrl.'\TransactionController@editProductList')->name('transaction.product.edit');
    Route::post('transaction-product',$ctrl.'\TransactionController@storeProductList')->name('transaction.product.store');
    Route::put('transaction-product/{id}',$ctrl.'\TransactionController@updateProductList')->name('transaction.product.update');
    Route::put('transaction/{id}',$ctrl.'\TransactionController@update')->name('transaction.update');
    Route::delete('transaction/{id}',$ctrl.'\TransactionController@destroy')->name('transaction.destroy');
    Route::get('transaction/detail/{id}',$ctrl.'\TransactionController@detail')->name('transaction.detail');
    Route::get('transaction/payment/{id}',$ctrl.'\TransactionController@pembayaran')->name('transaction.pembayaran');
    Route::get('transaction/{id}',$ctrl.'\TransactionController@edit')->name('transaction.edit');
    Route::post('transaction/update-transaction-status/{id}',$ctrl.'\TransactionController@updateTransactionStatus')->name('transaction.update.transaction.status');
    Route::post('transaction/update-payment-status/{id}',$ctrl.'\TransactionController@updatePaymentStatus')->name('transaction.update.payment.status');
    Route::get('admin/cart/create/{id}',$ctrl.'\CartController@admin_cart_create')->name('admin.cart.create');
    Route::post('admin/cart',$ctrl.'\CartController@admin_cart_store')->name('admin.cart.store');
    Route::get('admin/cart/delete/{id}',$ctrl.'\CartController@admin_cart_destroy')->name('admin.cart.destroy');
    Route::get('admin/cart/edit/{id}',$ctrl.'\CartController@admin_cart_edit')->name('admin.cart.edit');
    Route::put('admin/cart/update/{id}',$ctrl.'\CartController@admin_cart_update')->name('admin.cart.update');
    
    Route::middleware('auth')->get('profile',$ctrl.'\ProfileController@index')->name('profile.index');
    Route::middleware('auth')->put('profile/{id}',$ctrl.'\ProfileController@update')->name('profile.update');
    
    Route::middleware('auth')->get('report-transaction',$ctrl.'\ReportController@reportTransaction')->name('report.reportTransaction');
    Route::middleware('auth')->get('report-stock-product',$ctrl.'\ReportController@reportStockProduct')->name('report.reportStockProduct');
    
    Route::middleware('auth')->get('image/{file}',$ctrl.'\ImageController@image')->name('image');
    
    Route::middleware('auth')->get('print-struk',$ctrl.'\PrintController@printStruk')->name('print.struk');
    
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

});    

Route::get('download',$ctrl.'\ImageController@downloadFile')->name('download');
Route::get('print-pdf/{id}',$ctrl.'\PrintController@printPDF')->name('print.pdf');



// customer
Route::middleware('auth:customer')->group(function () {
    $ctrl = '\App\Http\Controllers';
    Route::get('profile-customer',$ctrl.'\ProfileController@profile_customer')->name('profile-customer.index');
    Route::put('profile-customer/{id}',$ctrl.'\ProfileController@update_profile_customer')->name('profile-customer.update');
    Route::get('add-to-cart/{id}',$ctrl.'\CartController@addToCart')->name('add.to.cart');
    Route::get('cart-list',$ctrl.'\CartController@cartListCustomer')->name('cart.list');
    Route::post('cart-payment',$ctrl.'\CartController@cartPaymentCustomer')->name('cart.payment');
    Route::put('update-cart/{id}',$ctrl.'\CartController@updatePelanggan')->name('cart.list.update');
    Route::post('cart',$ctrl.'\CartController@store')->name('cart.store');
    Route::get('cart/delete/{id}',$ctrl.'\CartController@destroy')->name('cart.destroy');
    Route::get('cart/edit/{id}',$ctrl.'\CartController@edit')->name('cart.edit');
    Route::put('cart/update/{id}',$ctrl.'\CartController@update')->name('cart.update');
    
    Route::get('transaction-customer', $ctrl . '\TransactionController@indexTransactionCustomer')->name('transaction.customer.index');
    Route::post('transaction-customer',$ctrl.'\TransactionController@storeTransactionCustomer')->name('transaction.customer.store');
    Route::get('transaction-customer/create',$ctrl.'\TransactionController@create')->name('transaction.customer.create');
    Route::get('transaction-customer-product/create/{id}',$ctrl.'\TransactionController@createProductList')->name('transaction.customer.product.create');
    Route::get('transaction-customer-product/delete/{id}',$ctrl.'\TransactionController@destroyProductList')->name('transaction.customer.product.destroy');
    Route::get('transaction-customer-product/edit/{id}',$ctrl.'\TransactionController@editProductList')->name('transaction.customer.product.edit');
    Route::post('transaction-customer-product',$ctrl.'\TransactionController@storeProductList')->name('transaction.customer.product.store');
    Route::put('transaction-customer-product/{id}',$ctrl.'\TransactionController@updateProductList')->name('transaction.customer.product.update');
    Route::put('transaction-customer/{id}',$ctrl.'\TransactionController@update')->name('transaction.customer.update');
    Route::delete('transaction-customer/{id}',$ctrl.'\TransactionController@destroy')->name('transaction.customer.destroy');
    Route::get('transaction-customer/detail/{id}',$ctrl.'\TransactionController@detailTransactionCustomer')->name('transaction.customer.detail');
    Route::get('transaction-customer/payment/{id}',$ctrl.'\TransactionController@pembayaran')->name('transaction.customer.pembayaran');
    Route::put('transaction-customer/payment/{id}',$ctrl.'\TransactionController@updatePembayaran')->name('transaction.customer.update.pembayaran');
    Route::get('transaction-customer/{id}',$ctrl.'\TransactionController@edit')->name('transaction.customer.edit');
    
    Route::get('address',$ctrl.'\AddressController@index')->name('customer.address');
    Route::get('address-create',$ctrl.'\AddressController@create')->name('customer.address.create');
    Route::post('address',$ctrl.'\AddressController@store')->name('customer.address.store');
    Route::get('address/{id}',$ctrl.'\AddressController@edit')->name('customer.address.edit');
    Route::put('address/{id}',$ctrl.'\AddressController@update')->name('customer.address.update');
    Route::delete('address/{id}',$ctrl.'\AddressController@destroy')->name('customer.address.destroy');
});
Route::get('product-list',$ctrl.'\ProductController@productList')->name('product-list');

Route::get('cart/create/{id}',$ctrl.'\CartController@create')->name('cart.create');

Route::get('/get-couriers',$ctrl.'\AddressController@getCouriers');
Route::get('/get-provinces',$ctrl.'\AddressController@getProvinces');
Route::get('/get-regencies/{provinceId}',$ctrl.'\AddressController@getRegencies');
Route::get('/get-districts/{regencyId}',$ctrl.'\AddressController@getDistricts');
Route::get('/get-villages/{districtId}',$ctrl.'\AddressController@getVillages');

