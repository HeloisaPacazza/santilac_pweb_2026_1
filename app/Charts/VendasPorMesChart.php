<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendasPorMesChart
{
    public function build()
    {
        // Obter dados de vendas por mês dos últimos 12 meses
        $meses = [];
        $dados = [];

        for ($i = 11; $i >= 0; $i--) {
            $data = Carbon::now()->subMonths($i);
            $mes = $data->format('Y-m');
            $mesNome = $data->locale('pt_BR')->format('M/Y');

            $quantidade = Venda::whereYear('created_at', $data->year)
                ->whereMonth('created_at', $data->month)
                ->count();

            $meses[] = $mesNome;
            $dados[] = $quantidade;
        }

        return (new LarapexChart)
            ->lineChart()
            ->setTitle('Vendas por Mês')
            ->setSubtitle('Quantidade de vendas nos últimos 12 meses')
            ->addData('Vendas', $dados)
            ->setXAxis($meses)
            ->setColors(['#1a3a52'])
            ->setStroke(2);
    }
}
