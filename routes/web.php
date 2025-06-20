<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Home pages
Route::prefix('/')->controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/dashboard', 'dashboard')->middleware('auth');
});

// Register
Route::prefix('/register')->middleware('guest')
    ->controller(RegisteredUserController::class)
    ->group(function () {
        Route::get('/', 'show');
        Route::post('/', 'create');
    });

// Login
Route::prefix('/login')->middleware('guest')
    ->controller(SessionController::class)
    ->group(function () {
        Route::get('/', 'show')->name('login');
        Route::post('/', 'create');
    });
Route::delete('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth');

// Jobs
Route::prefix('/jobs')->controller(JobController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');

    Route::middleware('auth')->group(function () {
        Route::get('/create', 'create');
        Route::post('/', 'store');
    });

    Route::get('/{job}', 'show');
    Route::middleware(['auth', 'can:edit,job'])->group(function () {
        Route::get('/{job}/edit', 'edit');
        Route::patch('/{job}', 'update');
        Route::delete('/{job}', 'destroy');
    });
});

// Tags
Route::prefix('/tags')->controller(TagController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{tag:name}', 'search');
});

// Employers
Route::prefix('/employers')->controller(EmployerController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{employer:name}', [EmployerController::class, 'search']);
});




