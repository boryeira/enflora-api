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
Route::Apiresource('orders', 'Orders\OrderController');
//orders
// Route::Apiresource('orders', 'Orders\OrderController');