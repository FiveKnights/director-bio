<?php

use App\Admin\Registry;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// The login screen is a purely cosmetic, client-side sequence (see
// public/js/portfolio-terminal.js), so a single public route is all we need.
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,10')   // 5 messages per 10 minutes per visitor
    ->name('contact.store');

   // The admin sections come from App\Admin\Registry
Route::pattern('resource', implode('|', array_keys(Registry::all())));

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', fn () => view('admin.dashboard', ['resources' => Registry::all()]))->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('{resource}', [ResourceController::class, 'index'])->name('index');
    Route::get('{resource}/create', [ResourceController::class, 'create'])->name('create');
    Route::post('{resource}', [ResourceController::class, 'store'])->name('store');
    Route::get('{resource}/{id}/edit', [ResourceController::class, 'edit'])->whereNumber('id')->name('edit');
    Route::put('{resource}/{id}', [ResourceController::class, 'update'])->whereNumber('id')->name('update');
    Route::delete('{resource}/{id}', [ResourceController::class, 'destroy'])->whereNumber('id')->name('destroy');
});