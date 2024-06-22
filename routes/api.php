<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'get']);
