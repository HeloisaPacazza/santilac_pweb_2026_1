@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Entregas</h2>

    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="{{ route('entregas.index') }}" class="d-flex gap-2">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por endereço..." value="">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('entregas.create') }}" class="btn btn-success">+ Nova Entrega</a>
            <a href="{{ route('pdf.entregas') }}" class="btn btn-danger">Relatório de Entregas</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Venda ID</th>
                <th>Endereço</th>
                <th>Data de Entrega</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entregas as $e)
            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $e->venda->id }}</td>
                <td>{{ $e->endereco }}</td>
                <td>{{ \Carbon\Carbon::parse($e->data_entrega)->format('d/m/Y H:i') }}</td>
                <td>{{ $e->status }}</td>
                <td>
                    <a href="{{ route('entregas.edit', $e) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form method="POST" action="{{ route('entregas.destroy', $e) }}" style="display:inline-block;" onsubmit="return confirm('Tem certeza?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Nenhuma entrega encontrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection