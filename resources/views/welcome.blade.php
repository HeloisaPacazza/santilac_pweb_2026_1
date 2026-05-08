@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1>Bem-vindo ao Sistema Santilac</h1>
        <p class="lead">Gerencie produtos, funcionários e vendas de forma fácil e rápida.</p>

        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
            <a href="{{ route('produtos.index') }}" class="btn btn-primary">Produtos</a>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-success">Funcionários</a>
            <a href="{{ route('vendas.index') }}" class="btn btn-warning">Vendas</a>

            <!-- NOVOS CRUDs -->
            <a href="{{ route('itens.index') }}" class="btn btn-success">Itens da Venda</a>
            <a href="{{ route('entregas.index') }}" class="btn btn-primary">Entregas</a>
        </div>
    </div>
</div>
@endsection