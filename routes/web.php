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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'App\Http\Controllers\FundsController@index');
Route::get('/clients/{client}/funds', 'App\Http\Controllers\FundsController@showFunds');
Route::prefix('cash-flow')->group(function () {
    Route::get('/', 'App\Http\Controllers\CashFlowController@index');
    Route::post('/', 'App\Http\Controllers\CashFlowController@addCashFlow');
    Route::post('/clients', 'App\Http\Controllers\CashFlowController@getClients');
    Route::post('/clients/{client}', 'App\Http\Controllers\CashFlowController@getClientData');
    Route::post('/clients/{client}/investments', 'App\Http\Controllers\CashFlowController@getInvestments');
    Route::post('/clients/{client}/investments/{investment}', 'App\Http\Controllers\CashFlowController@getInvestmentData');
});

