<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AcessorioController;
use App\Http\Controllers\ObraController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

Route::middleware('auth')->group(function () {
    Route::resource('acessorios', AcessorioController::class);

});

Route::middleware('auth')->group(function () {
    Route::resource('obras', ObraController::class);

});


require __DIR__.'/auth.php';