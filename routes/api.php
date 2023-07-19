<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
$ctrl = '\App\Http\Controllers';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('payment-notif', $ctrl.'\TransactionController@paymentNotifHandler');
Route::post('cek-ongkir', [CartController::class, 'cekOngkir']);
Route::get('get-address/{id}', [AddressController::class, 'getAddress']);