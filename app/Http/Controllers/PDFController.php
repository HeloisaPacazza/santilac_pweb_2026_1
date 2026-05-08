<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Entrega;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Gerar PDF de Vendas
     */
    public function generateVendasPDF()
    {
        $vendas = Venda::with('funcionario', 'itens.produto')->get();

        $data = [
            'title' => 'Relatório de Vendas',
            'date' => date('d/m/Y H:i:s'),
            'vendas' => $vendas
        ];

        $pdf = Pdf::loadView('relatorios.vendas_pdf', $data);

        return $pdf->download('relatorio_vendas_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Gerar PDF de Entregas
     */
    public function generateEntregasPDF()
    {
        $entregas = Entrega::with('venda.funcionario')->get();

        $data = [
            'title' => 'Relatório de Entregas',
            'date' => date('d/m/Y H:i:s'),
            'entregas' => $entregas
        ];

        $pdf = Pdf::loadView('relatorios.entregas_pdf', $data);

        return $pdf->download('relatorio_entregas_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
