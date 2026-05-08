<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Vendas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #275ba5;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="info">
        <p><strong>Data do Relatório:</strong> {{ $date }}</p>
        <p><strong>Total de Vendas:</strong> {{ $vendas->count() }}</p>
    </div>

    @if($vendas->count() > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Funcionário</th>
                <th>Produtos</th>
                <th>Quantidade Total</th>
                <th>Valor Total</th>
                <th>Data da Venda</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->funcionario->nome ?? '-' }}</td>
                <td>
                    @if($venda->itens->count() > 0)
                        @foreach($venda->itens as $item)
                            <strong>{{ $item->produto->nome ?? 'Produto excluído' }}</strong> (x{{ $item->quantidade }})<br>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td>{{ $venda->itens->sum('quantidade') }}</td>
                <td>R$ {{ number_format($venda->total, 2, ',', '.') }}</td>
                <td>{{ $venda->data_venda ? \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" style="text-align: right;"><strong>TOTAL GERAL:</strong></td>
                <td><strong>R$ {{ number_format($vendas->sum('total'), 2, ',', '.') }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    @else
    <p style="text-align: center; color: #999;">Nenhuma venda encontrada.</p>
    @endif
</body>
</html>
