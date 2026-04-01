@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Produtos</h2>

    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="{{ route('produtos.search') }}" class="d-flex gap-2">
                <select name="tipo" class="form-select" style="max-width: 180px;">
                    <option value="nome" {{ $tipo === 'nome' ? 'selected' : '' }}>por Nome</option>
                    <option value="preco" {{ $tipo === 'preco' ? 'selected' : '' }}>por Preço</option>
                    <option value="estoque" {{ $tipo === 'estoque' ? 'selected' : '' }}>por Estoque</option>
                </select>
                <input type="text" name="valor" class="form-control" placeholder="Digite aqui..." value="{{ $valor }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(!empty($valor))
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Limpar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('produtos.create') }}" class="btn btn-success">+ Novo Produto</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Peso (g)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $p)
            <tr>
                <td>{{ $p->nome }}</td>
                <td>R$ {{ number_format($p->preco, 2, ',', '.') }}</td>
                <td>{{ $p->estoque }}</td>
                <td>{{$p->peso }}</td>
                <td>
                    <a href="{{ route('produtos.edit', $p) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form method="POST" action="{{ route('produtos.destroy', $p) }}" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Nenhum produto encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection