<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response('OK', 200));

Route::get('/', [DonationController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/donation/{id}', [DonationController::class, 'show'])->name('donation.show');

Route::middleware('auth')->group(function () {
    Route::get('/donate', [DonationController::class, 'create'])->name('donate.create');
    Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
