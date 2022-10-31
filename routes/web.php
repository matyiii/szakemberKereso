<?php

use App\Http\Controllers\TradespersonController;
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

Route::get('/',[TradespersonController::class,'index'])->name('home');
Route::get('/addTp', function() {return view('addTradesperson');});
Route::get('/listAllTp',[TradespersonController::class,'listAllTp']);
Route::get('/getTradespersonData/{tradespersonId}',[TradespersonController::class,'getTradespersonData'])->name('getTradespersonData');

Route::post('/addTp',[TradespersonController::class,'addTradesperson']);
