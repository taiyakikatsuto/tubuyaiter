<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TubuyakiController;
use App\Http\Controllers\TubuyakiListController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('tubuyaki', TubuyakiController::class);

Route::prefix('tubuyaki')->name('tubuyaki.')->group(function() {
    Route::get('/list',  TubuyakiListController::class)->name('list');
});

Route::prefix('image')->name('image.')->controller(ImageController::class)->group(function(){
    Route::post('/upload',  'upload')->name('upload');
    Route::get('/show',  'show')->name('show');
    Route::get('/download',  'download')->name('download');
});


