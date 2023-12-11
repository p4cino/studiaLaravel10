<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ProductsController;

Route::group([
    "prefix" => "v1"
], function () {

    // Routes without authentication
    Route::post("register", [ApiController::class, "register"]);
    Route::post("login", [ApiController::class, "login"]);

    Route::get("products", [ProductsController::class, "index"]);
    Route::get("products/{product}", [ProductsController::class, "show"]);

    // Routes with authentication
    Route::group([
        "middleware" => ["auth:api"]
    ], function () {
        Route::get("profile", [ApiController::class, "profile"]);
        Route::get("logout", [ApiController::class, "logout"]);

        // Restricting access to store, destroy, and update methods to authenticated users
        Route::post("products/add", [ProductsController::class, "store"]);
        Route::delete("products/{product}", [ProductsController::class, "destroy"]);
        Route::put("products/{product}/edit", [ProductsController::class, "update"]);
    });
});