<?php

use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource("services", ServiceController::class);
Route::patch("services/{id}/activate", [ServiceController::class,"activate"]);
Route::patch("services/{id}/deactivate", [ServiceController::class,"deactivate"]);
Route::apiResource("customers", CustomersController::class);
Route::patch("services/{id}/activate", [ServiceController::class,"activate"]);
Route::patch("services/{id}/deactivate", [ServiceController::class,"deactivate"]);
Route::apiResource("subscription", SubscriptionController::class);
Route::patch("subscription/{id}/{status}", [SubscriptionController::class, "changeStatus"]);