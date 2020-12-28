<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Auth Routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    //Admin Routes
    Route::group(['middleware' => 'admin', 'prefix' => 'admin','as' => 'admin.'], function() {
        Route::resource('/dashboard',   App\Http\Controllers\Admin\DashboardController::class);
        Route::resource('/ticket',      App\Http\Controllers\Admin\TicketController::class);
        Route::resource('/client',      App\Http\Controllers\Admin\ClientController::class);
    });

    //Client Routes
    Route::group(['middleware' => 'client', 'prefix' => 'client','as' => 'client.'], function() {
        Route::resource('/dashboard', App\Http\Controllers\Client\DashboardController::class);
        Route::resource('/ticket', App\Http\Controllers\Client\TicketController::class);
    });

});

