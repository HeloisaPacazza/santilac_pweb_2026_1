@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Novo Item de Venda</h2>

    <form method="POST" action="{{ route('itens.store') }}">
        @csrf

        <div class="mb-3">
            <label for="venda_id" class="form-label">Venda</label>
            <select class="form-select" id="venda_id" name="venda_id" required>
                @foreach($vendas as $v)
                    <option value="{{ $v->id }}">Venda #{{ $v->id }}</option>
                @endforeach
            </select>
            @error('venda_id')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select class="form-select" id="produto_id" name="produto_id" required>
                @foreach($produtos as $p)
                    <option value="{{ $p->id }}">{{ $p->nome }}</option>
                @endforeach
            </select>
            @error('produto_id')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="0" required>
                    @error('quantidade')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="preco_unitario" class="form-label">Preço Unitário</label>
                    <input type="number" step="0.01" class="form-control" id="preco_unitario" name="preco_unitario" placeholder="0.00" required>
                    @error('preco_unitario')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('itens.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection 