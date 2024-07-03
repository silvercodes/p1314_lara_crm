<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'categories',
    'controller' => CategoryController::class,
], function() {
    Route::get('/{category}', 'get');
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::patch('/{category}', 'patch');
    Route::put('/{category}', 'put');
    Route::delete('/{category}', 'delete');
});

Route::group([
        'prefix' => 'projects',
        'controller' => ProjectController::class,
], function() {
    Route::get('/{project}', 'get');
    Route::post('/', 'store');
    Route::delete('/{project}', 'delete');
    Route::get('/{project}/download', 'download');
});
