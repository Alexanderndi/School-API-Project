<?php

use App\Http\Controllers\StudentsCoursesEnrollmentsController;
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

Route::group(
    ["middleware" => ["auth:sanctum"]],
    function () {
        Route::POST("/enrollments", [StudentsCoursesEnrollmentsController::class, "update"]);
        Route::GET("/enrollments/{id}", [StudentsCoursesEnrollmentsController::class, "get"]);
        Route::DELETE("/enrollments/{id}", [StudentsCoursesEnrollmentsController::class, "softDelete"]);
        //Route::PATCH("/students/{id}", [StudentsController::class, "update"]);
    }
);
