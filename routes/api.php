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

// Route::prefix('tubuyakies')->group(function() {
//     // Route::get('/list',  TubuyakiListController::class)->name('list');
// });
Route::apiResource('tubuyakies', TubuyakiController::class);

Route::prefix('images')->controller(ImageController::class)->group(function(){
    Route::post('/upload',  'upload');
    Route::get('/{id}',  'show');
    Route::get('/download',  'download');
});


