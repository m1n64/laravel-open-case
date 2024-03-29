<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['name' => 'case.*', 'prefix' => 'case'], function () {
    Route::get('/open/{id}', [\App\Http\Controllers\Game\Api\OpenCaseController::class, 'open']);
});
