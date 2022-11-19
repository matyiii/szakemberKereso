<?php

use App\Http\Controllers\TradespersonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListAllTpController;
use Illuminate\Support\Facades\Auth;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::middleware('auth')->group(function () {
    #Home view
    Route::get('/', [HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');
    Route::post('/addTp', [TradespersonController::class, 'addTradesperson']);
    Route::get('/listAllTp/{professionId}', [HomeController::class, 'listSelectedTrade'])->name('listAllTp')->withoutMiddleware('auth');

    #addTradeperson view
    Route::get('/addTp', function () {
        return view('addTradesperson');
    });

    #listAllTp view
    Route::get('/listAllTp', [ListAllTpController::class, 'listAllTp'])->name('allTp')->withoutMiddleware('auth');
    Route::get('/getTradespersonData/{tradespersonId}', [ListAllTpController::class, 'getTradespersonData'])->name('getTradespersonData')->withoutMiddleware('auth');
    Route::get('/getSearchedData',[ListAllTpController::class,'getSearchedData'])->name('getSearchedData')->withoutMiddleware('auth');

    #login view
    Route::get('/login', [HomeController::class, 'index'])->name('login');
});

Auth::routes();
