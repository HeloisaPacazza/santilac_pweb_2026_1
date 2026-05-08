<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ItensVendaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\GraficoController;

Route::get('welcome', function () {
    return view('welcome');
});


// BUSCAS
Route::get('produtos/search', [ProdutoController::class, 'search'])->name('produtos.search');

Route::get('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');

Route::get('vendas/search', [VendaController::class, 'search'])->name('vendas.search');


// CRUDS
Route::resource('produtos', ProdutoController::class);

Route::resource('funcionarios', FuncionarioController::class);

Route::resource('vendas', VendaController::class);

Route::resource('itens', ItensVendaController::class);

Route::resource('entregas', EntregaController::class);


// PDFs
Route::get('/relatorio-vendas', [VendaController::class, 'relatorio'])
    ->name('relatorio.vendas');

Route::get('/relatorio-produtos', [ProdutoController::class, 'relatorio'])
    ->name('relatorio.produtos');

Route::get('/pdf-vendas', [PDFController::class, 'generateVendasPDF'])
    ->name('pdf.vendas');

Route::get('/pdf-entregas', [PDFController::class, 'generateEntregasPDF'])
    ->name('pdf.entregas');


// GRÁFICOS
Route::get('/graficos-vendas', [GraficoController::class, 'vendas'])
    ->name('graficos.vendas');


// GRÁFICOS
// Route::get('/graficos', [DashboardController::class, 'index'])
//     ->name('graficos');