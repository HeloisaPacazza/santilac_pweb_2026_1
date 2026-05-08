<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Itens_venda;
use Illuminate\Support\Facades\DB;

class VendasPorProdutoChart
{
    public function build()
    {
        // Obter dados de vendas por produto, apenas produtos existentes
        $vendas = Itens_venda::join('produtos', 'produtos.id', '=', 'itens_vendas.produto_id')
            ->select('produtos.nome as produto_nome', DB::raw('COUNT(*) as total'))
            ->groupBy('itens_vendas.produto_id', 'produtos.nome')
            ->get();

        $labels = [];
        $data = [];

        foreach ($vendas as $venda) {
            $labels[] = $venda->produto_nome;
            $data[] = $venda->total;
        }

        if (empty($data)) {
            $labels = ['Sem vendas'];
            $data = [1];
        }

        return (new LarapexChart)
            ->pieChart()
            ->setTitle('Vendas por Produto')
            ->setSubtitle('Quantidade de vendas de cada produto')
            ->addData($data)
            ->setLabels($labels)
            ->setColors(['#1a3a52', '#2d5f8d', '#4a8bbf', '#6fa3d4', '#97bce0', '#c3d9ed']);
    }
}
