<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

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
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/students", [StudentsController::class, "update"]);
        Route::GET("/students/{id}", [StudentsController::class, "get"]);
        Route::DELETE("/students/{id}", [StudentsController::class, "softDelete"]);
        //Route::PATCH("/students/{id}", [StudentsController::class, "update"]);
    }
);
