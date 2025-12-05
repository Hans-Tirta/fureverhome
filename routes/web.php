<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
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

    // Adoption routes
    Route::get('/adoptions/my-requests', [AdoptionController::class, 'myRequests'])
        ->name('adoptions.my-requests');
    Route::get('/pets/{pet}/adopt', [AdoptionController::class, 'create'])
        ->name('adoptions.create');
    Route::post('/adoptions', [AdoptionController::class, 'store'])
        ->name('adoptions.store');
    Route::get('/adoptions/{adoption}', [AdoptionController::class, 'show'])
        ->name('adoptions.show');
    Route::patch('/adoptions/{adoption}', [AdoptionController::class, 'update'])
        ->name('adoptions.update');
    Route::delete('/adoptions/{adoption}', [AdoptionController::class, 'destroy'])
        ->name('adoptions.destroy');

    // Adoption management (shelter & admin)
    Route::get('/adoptions', [AdoptionController::class, 'index'])
        ->name('adoptions.index');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
