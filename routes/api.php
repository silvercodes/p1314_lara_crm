<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'categories',
    'controller' => CategoryController::class
], function() {
    Route::get('/{category}', 'get');
    Route::get('/', 'index');
});