<?php

use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::group(['prefix' => 'v1'], function () {
//     Route::apiResource('customers', CustomerController::class);
//     Route::apiResource('invoices', InvoiceController::class);
//     Route::post('invoices/bulk', ['uses' => 'App\Http\Controllers\Api\v1\InvoiceController@bulkStore']);
// });

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::post('invoices/bulk', ['uses' => 'App\Http\Controllers\Api\v1\InvoiceController@bulkStore']);
});