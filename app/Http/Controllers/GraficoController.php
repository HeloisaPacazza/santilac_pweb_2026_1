<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\VendasPorProdutoChart;
use App\Charts\VendasPorMesChart;

class GraficoController extends Controller
{
    /**
     * Exibir gráficos de vendas
     */
    public function vendas(VendasPorProdutoChart $chartProduto, VendasPorMesChart $chartMes)
    {
        return view('graficos.vendas', [
            'chartProduto' => $chartProduto->build(),
            'chartMes' => $chartMes->build()
        ]);
    }
}
