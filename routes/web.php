<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get("/product", [ProductController::class,"index"])->name("products.index");
Route::get("/product/create", [ProductController::class,"create"])->name("products.create");
Route::post("/product", [ProductController::class,"store"])->name("products.store");
Route::get("/product/{product}/edit", [ProductController::class,"edit"])->name("products.edit");


