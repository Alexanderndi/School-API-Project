<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesController;

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
        Route::POST("/courses", [CoursesController::class, "update"]);
        Route::GET("/courses/{id}", [CoursesController::class, "get"]);
        Route::DELETE("/courses/{id}", [CoursesController::class, "softDelete"]);
        //Route::PATCH("/students/{id}", [StudentsController::class, "update"]);
    }
);
