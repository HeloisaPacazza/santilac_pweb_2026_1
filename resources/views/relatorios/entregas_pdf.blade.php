<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Entregas</title>
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
            background-color: #2196F3;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .status-entregue {
            background-color: #c8e6c9;
        }
        .status-pendente {
            background-color: #ffe0b2;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="info">
        <p><strong>Data do Relatório:</strong> {{ $date }}</p>
        <p><strong>Total de Entregas:</strong> {{ $entregas->count() }}</p>
    </div>

    @if($entregas->count() > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Venda ID</th>
                <th>Funcionário</th>
                <th>Endereço</th>
                <th>Data de Entrega</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entregas as $entrega)
            <tr>
                <td>{{ $entrega->id }}</td>
                <td>{{ $entrega->venda_id }}</td>
                <td>{{ $entrega->venda->funcionario->nome ?? '-' }}</td>
                <td>{{ $entrega->endereco }}</td>
                <td>{{ \Carbon\Carbon::parse($entrega->data_entrega)->format('d/m/Y H:i') }}</td>
                <td>{{ $entrega->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; color: #999;">Nenhuma entrega encontrada.</p>
    @endif
</body>
</html>
