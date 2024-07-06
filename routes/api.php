<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);

Route::get('/refresh', [AuthController::class, 'refresh'])
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::REFRESH_ACCESS_TOKEN->value
    ]);

Route::group([
    'middleware' => [
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ]
], function () {

    Route::get('/signout', [AuthController::class, 'signout']);

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
        Route::patch('/{project}', 'patch');

        Route::get('/{project}/download', 'download');
    });
});



