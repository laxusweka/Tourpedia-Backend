<?php

use App\Http\Controllers\API\ApiCulinaryController;
use App\Http\Controllers\API\ApiDestinationController;
use App\Http\Controllers\API\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('about-me', [ApiUserController::class, 'about_me']);
        Route::post('logout', [ApiUserController::class, 'logout']);
        Route::post('destinations/favorite/{destination}', [App\Http\Controllers\FavoriteController::class, 'destination_favorite']);
        Route::get('destinations/my-favorites', [App\Http\Controllers\FavoriteController::class, 'destination_myFavorites']);
        Route::get('destinations/check-favorite/{destination}', [App\Http\Controllers\FavoriteController::class, 'destination_check_favorite']);

        Route::post('culinaries/favorite/{culinary}', [App\Http\Controllers\FavoriteController::class, 'culinary_favorite']);
        Route::get('culinaries/my-favorites', [App\Http\Controllers\FavoriteController::class, 'culinary_myFavorites']);
        Route::get('culinaries/check-favorite/{culinary}', [App\Http\Controllers\FavoriteController::class, 'culinary_check_favorite']);
    });
Route::prefix('user')->group(function () {
    Route::post('register', [ApiUserController::class, 'register']);
    Route::post('login', [ApiUserController::class, 'login']);
});

Route::prefix('culinaries')->group(function () {
    Route::get('/', [ApiCulinaryController::class, 'index']);
    Route::get('random', [ApiCulinaryController::class, 'random']);
    Route::get('{destination}', [ApiCulinaryController::class, 'show']);
});

Route::get('destinations/random', [ApiDestinationController::class, 'random']);
Route::resource('destinations', '\App\Http\Controllers\API\ApiDestinationController');
