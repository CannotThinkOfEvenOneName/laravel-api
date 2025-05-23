<?php

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("/register", [UserController::class, "registerApi"]);
Route::post("/login", [UserController::class, "loginApi"]);

Route::post("/products/add-product", [ProductController::class, "addProductApi"])->middleware('auth:sanctum');
Route::get("/products/get-all-product", [ProductController::class, "getProductsApi"]);
Route::delete("/products/{product}/delete-product", [ProductController::class, "deleteProductApi"])->middleware('auth:sanctum');
Route::put("/products/{product}/update-product", [ProductController::class, "updateProductApi"])->middleware('auth:sanctum');

Route::post("/carts/add-to-cart", [CartItemController::class, "addToCartApi"])->middleware('auth:sanctum');
Route::get("/carts/get-cart-items", [CartItemController::class, "getAllCartItemsApi"])->middleware("auth:sanctum");
Route::delete("/carts/{cartItem}/delete-cart-item", [CartItemController::class, "deleteCartItemApi"])->middleware('auth:sanctum');
