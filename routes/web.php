<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['auth', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    // Citizens CRUD
    Route::controller(\App\Http\Controllers\CitizenController::class)->group(function () {
        Route::get('/citizens', 'index')->name('citizens.index');
        Route::get('/citizens/create', 'create')->name('citizens.create');
        Route::post('/citizens', 'store')->name('citizens.store');
        Route::get('/citizens/{citizen}/edit', 'edit')->name('citizens.edit');
        Route::put('/citizens/{citizen}', 'update')->name('citizens.update');
        Route::delete('/citizens/{citizen}', 'destroy')->name('citizens.destroy');
    });

    // Pension Schemes CRUD
    Route::controller(\App\Http\Controllers\PensionSchemeController::class)->group(function () {
        Route::get('/pension-schemes', 'index')->name('pension-schemes.index');
        Route::get('/pension-schemes/create', 'create')->name('pension-schemes.create');
        Route::post('/pension-schemes', 'store')->name('pension-schemes.store');
        Route::get('/pension-schemes/{pensionScheme}/edit', 'edit')->name('pension-schemes.edit');
        Route::put('/pension-schemes/{pensionScheme}', 'update')->name('pension-schemes.update');
        Route::delete('/pension-schemes/{pensionScheme}', 'destroy')->name('pension-schemes.destroy');
    });

    // Citizen Pensions CRUD
    Route::controller(\App\Http\Controllers\CitizenPensionController::class)->group(function () {
        Route::get('/citizen-pensions', 'index')->name('citizen-pensions.index');
        Route::get('/citizen-pensions/create', 'create')->name('citizen-pensions.create');
        Route::post('/citizen-pensions', 'store')->name('citizen-pensions.store');
        Route::get('/citizen-pensions/{citizenPension}/edit', 'edit')->name('citizen-pensions.edit');
        Route::put('/citizen-pensions/{citizenPension}', 'update')->name('citizen-pensions.update');
        Route::delete('/citizen-pensions/{citizenPension}', 'destroy')->name('citizen-pensions.destroy');
    });

    // Duplicate Detection
    Route::controller(\App\Http\Controllers\DuplicateDetectionController::class)->group(function () {
        Route::get('/duplicate-detection', 'index')->name('duplicate-detection.index');
        Route::post('/duplicate-detection/scan', 'scan')->name('duplicate-detection.scan');
    });

    // Reports
    Route::get('/reports', [\App\Http\Controllers\ReportsController::class, 'index'])->name('reports.index');

    // Search
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
});