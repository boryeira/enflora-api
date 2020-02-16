<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Productos
Route::get('products/actives', 'Products\ProductController@actives');
Route::Apiresource('products', 'Products\ProductController');
//orders
Route::get('orders/actives', 'Orders\OrderController@actives');
Route::Apiresource('orders', 'Orders\OrderController');
Route::get('/orders/{order}/items','Orders\OrderController@items')->name('orders.items');
Route::get('/orders/{order}/pay','Flow\FlowController@orderpay')->name('orders.pay');
//orders
// Route::Apiresource('orders', 'Orders\OrderController');

//User
Route::post('fcm/token', 'User\UserController@fcmToken');
Route::get('profile/prescriptions', 'User\PrescriptionController@index');


