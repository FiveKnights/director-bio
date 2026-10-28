<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use Illuminate\Support\Facades\Route;

// The login screen is a purely cosmetic, client-side sequence (see
// public/js/portfolio-terminal.js), so a single public route is all we need.
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,10')   // 5 messages per 10 minutes per visitor
    ->name('contact.store');

    // The login route must be named "login" so Laravel's auth middleware can redirect to it
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.projects.index'))->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('skills', SkillController::class)->except('show');
});