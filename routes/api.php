<?php

use App\Http\Controllers\API\V1\Auth\AuthSocialController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\BusinessController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\RatingController;
use App\Http\Controllers\API\V1\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/loginSocial', AuthSocialController::class);
Route::get('/sliders', SliderController::class);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/business', [BusinessController::class, 'index']);
Route::get('/business/{business}', [BusinessController::class, 'show']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/business', [BusinessController::class, 'store']);
    Route::delete('/business/{business}', [BusinessController::class, 'destroy']);
    Route::post('/business/{business}/review', [RatingController::class, 'store']);
    Route::get('/my-business', [BusinessController::class, 'mybusiness']);
    Route::post('auth/logout', LogoutController::class);
});
