<?php

use App\Application\Transaction\Http\Controllers\TransactionController;
use App\Application\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your Application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    die('hellow');
});


Route::group(['prefix' => 'user'], function() {
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/', [UserController::class, 'index'])->name('index');
} );

Route::group(['prefix' => 'transaction'], function() {
    Route::post('/', [TransactionController::class, 'store'])->name('store');
} );
