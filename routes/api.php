<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\BeerController as AdminBeerController;
use App\Http\Controllers\Api\BeerController as ClientBeerController;

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

Route::prefix('admin')->group(function () {
    Route::apiResource('beers', AdminBeerController::class)
        ->except('show');
});

Route::apiResource('beers', ClientBeerController::class)
    ->only(['index', 'show']);

