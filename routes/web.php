<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AcessorioController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\EstoqueController;

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

Route::middleware('auth')->group(function () {
    Route::get('estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('estoque', [EstoqueController::class, 'store'])->name('estoque.store');

    Route::get('estoque/{estoque}/retirar', [EstoqueController::class, 'retirar'])->name('estoque.retirar');
    Route::post('estoque/{estoque}/retirar', [EstoqueController::class, 'processarRetirada'])->name('estoque.processarRetirada');
});

Route::middleware('auth')->group(function () {
    Route::get('historico', [HistoricoController::class, 'index'])->name('historico.index');

});



require __DIR__.'/auth.php';