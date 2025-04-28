<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post("/admins/register", []);

Route::post("/users/register", [UserController::class, "registerApi"]);
Route::post("/users/login", [UserController::class, "loginApi"]);

Route::post("/admins/register", [AdminController::class, "registerApi"]);
Route::post("/admins/login", [AdminController::class, "loginApi"]);

Route::post("/products", [ProductController::class, "addProductApi"])->middleware('auth:sanctum');