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

//flow
Route::post('/flow/return','Flow\FlowController@returnFlow')->name('orders.flow.return');
Route::post('/flow/confirm','Flow\FlowController@confirmFlow')->name('orders.flow.confirm');
Route::get('/flow/return',function () {
    return view('flow.return');
});
Route::get('/flow/error',function () {
    return view('flow.error');
});

