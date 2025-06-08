<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home pages
Route::prefix('/')->controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
});


