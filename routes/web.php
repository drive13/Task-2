<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Models\SalesOrder;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/product', ProductController::class)->middleware('auth');
Route::resource('/customer', CustomerController::class)->middleware('auth');
Route::resource('/orders', SalesOrderController::class)->middleware('auth');

require __DIR__ . '/auth.php';
