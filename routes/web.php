<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Public pet routes (accessible to everyone)
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/{pet}', [PetController::class, 'show'])
    ->whereNumber('pet')
    ->name('pets.show');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Pet management routes (for shelter & admin only)
    Route::get('/pets/manage', [PetController::class, 'manage'])->name('pets.manage');
    Route::resource('pets', PetController::class)->except(['index', 'show']);
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
