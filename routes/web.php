<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    return Inertia::render('Index');
});


Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/reservation', [ReservationController::class, 'index']);
    Route::post('/reservation', [ReservationController::class, 'store']);
    Route::put('/reservation', [ReservationController::class, 'update']);

});


