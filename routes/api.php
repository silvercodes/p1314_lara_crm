<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'categories',
    'controller' => CategoryController::class
], function() {
    Route::get('/{category}', 'get');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::patch('/{category}', 'patch');
    Route::put('/{category}', 'put');
    Route::delete('/{category}', 'delete');
});
