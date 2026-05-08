@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Itens de Venda</h2>

    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="{{ route('itens.index') }}" class="d-flex gap-2">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por produto..." value="{{ $busca ?? '' }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(!empty($busca))
                    <a href="{{ route('itens.index') }}" class="btn btn-secondary">Limpar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('itens.create') }}" class="btn btn-success">+ Novo Item</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Venda ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($itens as $item)
            <tr>
                <td>{{ $item->venda->id }}</td>
                <td>{{ $item->produto->nome ?? 'Produto excluído' }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum item encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection