@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Funcionários</h2>

    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="{{ route('funcionarios.search') }}" class="d-flex gap-2">
                <select name="tipo" class="form-select" style="max-width: 180px;">
                    <option value="nome" {{ $tipo === 'nome' ? 'selected' : '' }}>por Nome</option>
                    <option value="email" {{ $tipo === 'email' ? 'selected' : '' }}>por Email</option>
                    <option value="telefone" {{ $tipo === 'telefone' ? 'selected' : '' }}>por Telefone</option>
                </select>
                <input type="text" name="valor" class="form-control" placeholder="Digite aqui..." value="{{ $valor }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(!empty($valor))
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Limpar</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('funcionarios.create') }}" class="btn btn-success">+ Novo Funcionário</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Carga Horária</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($funcionarios as $f)
            <tr>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->email }}</td>
                <td>{{ $f->telefone }}</td>
                <td>{{ $f->carga_horaria }}h</td>
                <td>
                    <a href="{{ route('funcionarios.edit', $f) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form method="POST" action="{{ route('funcionarios.destroy', $f) }}" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Nenhum funcionário encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection