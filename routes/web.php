<?php

use App\Http\Controllers\Admin\AdminController;
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
    return view('landing.index');
});

// Route::middleware(['auth:sanctum', 'verified', 'is.admin'])->get('/admin', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified', 'is.admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('destination', '\App\Http\Controllers\Admin\DestinationController');
        Route::resource('destination-image', '\App\Http\Controllers\Admin\DestinationImageController');

        Route::resource('culinary', '\App\Http\Controllers\Admin\CulinaryController');
        Route::resource('culinary-image', '\App\Http\Controllers\Admin\CulinaryImageController');

        Route::resource('user', '\App\Http\Controllers\Admin\UserController');
    });
