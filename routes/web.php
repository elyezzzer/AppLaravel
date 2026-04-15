<?php

use App\Http\Controllers\AcessorioController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('acessorios', AcessorioController::class);
    Route::resource('obras', ObraController::class);

    Route::get('estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('estoque', [EstoqueController::class, 'store'])->name('estoque.store');

    Route::get('estoque/{estoque}/retirar', [EstoqueController::class, 'retirar'])->name('estoque.retirar');
    Route::post('estoque/{estoque}/retirar', [EstoqueController::class, 'processarRetirada'])->name('estoque.processarRetirada');

    Route::get('historico', [HistoricoController::class, 'index'])->name('historico.index');

    Route::prefix('relatorios')->group(function () {
        Route::get('/', [RelatorioController::class, 'index'])->name('relatorios.index');
        Route::get('/create', [RelatorioController::class, 'create'])->name('relatorios.create');
        Route::post('/gerar', [RelatorioController::class, 'gerar'])->name('relatorios.gerar');
        Route::get('/{id}/download', [RelatorioController::class, 'download'])->name('relatorios.download');
        Route::delete('/relatorios/{id}', [RelatorioController::class, 'destroy'])->name('relatorios.destroy');
        Route::get('/{id}/view', [RelatorioController::class, 'view'])->name('relatorios.view');

    });
});

require __DIR__.'/auth.php';