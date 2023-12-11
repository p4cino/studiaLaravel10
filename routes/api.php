<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;

Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:api"]
], function () {

    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
});

// Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    // Route::post('login', [AuthenticationController::class, 'store']);
    // Route::post('logout', [AuthenticationController::class, 'destroy'])->middleware('auth:api');
// });


// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);

// Route::middleware('auth:api')->group(function () {
//     Route::resource('products', ProductsController::class);
// });
