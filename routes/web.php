<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShelterController;
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

// Public article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Public shelter profile
Route::get('/shelters/{shelter}', [ShelterController::class, 'show'])->name('shelters.show');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Pet management routes (for shelter & admin only)
    Route::get('/pets/manage', [PetController::class, 'manage'])->name('pets.manage');
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::patch('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');

    // Adoption routes
    Route::get('/adoptions', [AdoptionController::class, 'index'])->name('adoptions.index');
    Route::get('/adoptions/my-requests', [AdoptionController::class, 'myRequests'])->name('adoptions.my-requests');
    Route::get('/pets/{pet}/adopt', [AdoptionController::class, 'create'])->name('adoptions.create');
    Route::post('/adoptions', [AdoptionController::class, 'store'])->name('adoptions.store');
    Route::get('/adoptions/{adoption}', [AdoptionController::class, 'show'])->name('adoptions.show');
    Route::patch('/adoptions/{adoption}', [AdoptionController::class, 'update'])->name('adoptions.update');
    Route::delete('/adoptions/{adoption}', [AdoptionController::class, 'destroy'])->name('adoptions.destroy');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/shelter', [ProfileController::class, 'updateShelter'])->name('profile.shelter.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/shelters', [AdminController::class, 'shelters'])->name('shelters');
    Route::patch('/shelters/{shelter}/approve', [AdminController::class, 'approveShelter'])->name('shelters.approve');
});

require __DIR__ . '/auth.php';
