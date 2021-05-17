<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\GuestDashboardController;
use App\Http\Controllers\Guest\GuestReservationController;
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
    Route::get('/dashboard', [GuestDashboardController::class, 'index']);

    Route::get('/my-reservations', [GuestReservationController::class, 'index']);
    Route::post('/my-reservations', [GuestReservationController::class, 'store']);
    Route::put('/my-reservations/{reservation}', [GuestReservationController::class, 'update']);
    Route::delete('/my-reservations/{reservation}', [GuestReservationController::class, 'destroy']);

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::get('/reservations', [AdminReservationController::class, 'index']);
        Route::put('/reservations/{reservation}', [AdminReservationController::class, 'update']);
    });
});


