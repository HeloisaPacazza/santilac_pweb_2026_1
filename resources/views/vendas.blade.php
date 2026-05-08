<h1>Relatório de Vendas</h1>

@foreach($dados as $v)
    <p>
        Venda #{{ $v->id }} -
        Cliente: {{ $v->cliente->nome ?? 'Sem cliente' }}
    </p>
@endforeach