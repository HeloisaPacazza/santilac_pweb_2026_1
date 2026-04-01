@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Editar Funcionário</h2>

    <form method="POST" action="{{ route('funcionarios.update', $funcionario) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $funcionario->nome }}" required>
            @error('nome')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $funcionario->email }}" required>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $funcionario->telefone }}" required>
                    @error('telefone')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="carga_horaria" class="form-label">Carga Horária (h)</label>
                    <input type="number" class="form-control" id="carga_horaria" name="carga_horaria" value="{{ $funcionario->carga_horaria }}" required>
                    @error('carga_horaria')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection