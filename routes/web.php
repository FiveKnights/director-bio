<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// The login screen is a purely cosmetic, client-side sequence (see
// public/js/portfolio-terminal.js), so a single public route is all we need.
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,10')   // 5 messages per 10 minutes per visitor
    ->name('contact.store');