<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanctumController;

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

Route::group(
    ["middleware" => []],
    function () {
        Route::POST("/sanctum/token", [SanctumController::class, "issueToken"]);
    }
);
