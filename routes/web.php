<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/broadcasting/auth', function () {
    return Auth::user();
});

Route::get('/', function () {
    $cases = \App\Models\Case\WeaponCase::whereTypeId(1)->get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cases' => $cases,
    ]);
});

Route::get('/case/{id}', function (int $id) {
    $case =  \App\Models\Case\WeaponCase::with(['key'])->find($id);
    $skins = $case->skins()->with(['rarity', 'category', 'pattern'])->get();

    return Inertia::render('Case', [
       'case_' => $case,
       'skins' => $skins
   ]);
})->name('case.id');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
