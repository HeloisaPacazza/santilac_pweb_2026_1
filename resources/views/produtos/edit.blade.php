@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Editar Produto</h2>

    <form method="POST" action="{{ route('produtos.update', $produto) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
            @error('nome')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="{{ $produto->preco }}" required>
                    @error('preco')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque" value="{{ $produto->estoque }}" required>
                    @error('estoque')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso (g)</label>
            <input type="number" step="0.001" class="form-control" id="peso" name="peso" value="{{ $produto->peso }}" required>
            @error('peso')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection