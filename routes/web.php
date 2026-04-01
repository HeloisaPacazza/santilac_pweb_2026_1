<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VendaController;

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('produtos/search', [ProdutoController::class, 'search'])->name('produtos.search');
Route::get('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');
Route::get('vendas/search', [VendaController::class, 'search'])->name('vendas.search');

Route::resource('produtos', ProdutoController::class);
Route::resource('funcionarios', FuncionarioController::class);
Route::resource('vendas', VendaController::class);
