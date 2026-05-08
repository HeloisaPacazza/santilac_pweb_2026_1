@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Gráficos de Vendas</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Vendas por Produto (Pizza)</h5>
                </div>
                <div class="card-body">
                    {!! $chartProduto->container() !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Vendas por Mês (Linhas)</h5>
                </div>
                <div class="card-body">
                    {!! $chartMes->container() !!}
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ $chartProduto->cdn() }}"></script>
{{ $chartProduto->script() }}

<script src="{{ $chartMes->cdn() }}"></script>
{{ $chartMes->script() }}

@endsection
