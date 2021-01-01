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
        //Dashboard
        Route::resource('/dashboard',   App\Http\Controllers\Admin\DashboardController::class);

        //Ticket
        Route::get('/ticket/closed',      [App\Http\Controllers\Admin\TicketController::class, 'closed'])->name('ticket.closed');
        Route::get('/ticket/ticketList',      [App\Http\Controllers\Admin\TicketController::class, 'ticketList'])->name('ticket.ticketList');
        Route::resource('/ticket',      App\Http\Controllers\Admin\TicketController::class);

        //Clients
        Route::resource('/client',      App\Http\Controllers\Admin\ClientController::class);

        //SuperAdmin
        Route::group(['middleware' => 'superadmin'], function() {
            //Staff
            Route::resource('/staff',   App\Http\Controllers\Admin\StaffController::class);
        });

    });

    //Client Routes
    Route::group(['middleware' => 'client', 'prefix' => 'client','as' => 'client.'], function() {
        Route::resource('/dashboard', App\Http\Controllers\Client\DashboardController::class);
        Route::resource('/ticket', App\Http\Controllers\Client\TicketController::class);
    });

});

