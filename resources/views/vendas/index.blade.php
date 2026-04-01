@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Vendas</h2>

    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="{{ route('vendas.search') }}" class="d-flex gap-2">
                <select name="tipo" class="form-select" style="max-width: 180px;">
                    <option value="funcionario" {{ $tipo === 'funcionario' ? 'selected' : '' }}>por Funcionário</option>
                    <option value="total" {{ $tipo === 'total' ? 'selected' : '' }}>por Total</option>
                </select>
                <input type="text" name="valor" class="form-control" placeholder="Digite aqui..." value="{{ $valor }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(!empty($valor))
                    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Limpar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('vendas.create') }}" class="btn btn-success">+ Nova Venda</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Funcionário</th>
                <th>Produtos</th>
                <th>Total</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendas as $v)
            <tr>
                <td>{{ $v->funcionario->nome }}</td>
                <td>
                    @if($v->produtos)
                        <ul class="mb-0">
                            @foreach(json_decode($v->produtos) as $item)
                                @php
                                    $produto = \App\Models\Produto::find($item->id);
                                @endphp
                                @if($produto)
                                    <li>{{ $produto->nome }} x{{ $item->quantidade }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td><strong>R$ {{ number_format($v->total, 2, ',', '.') }}</strong></td>
                <td>{{ $v->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('vendas.edit', $v) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form method="POST" action="{{ route('vendas.destroy', $v) }}" style="display:inline-block;"
                          onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Nenhuma venda encontrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
