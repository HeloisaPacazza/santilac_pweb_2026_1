@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Entrega</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('entregas.update', $entrega) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="venda_id" class="form-label">Venda</label>
                            <select name="venda_id" id="venda_id" class="form-select" required>
                                <option value="">Selecione uma venda</option>
                                @foreach($vendas as $v)
                                    <option value="{{ $v->id }}" {{ $entrega->venda_id == $v->id ? 'selected' : '' }}>Venda #{{ $v->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" value="{{ old('endereco', $entrega->endereco) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', $entrega->cidade) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data_entrega" class="form-label">Data de Entrega</label>
                                <input type="datetime-local" name="data_entrega" id="data_entrega" class="form-control" value="{{ old('data_entrega', optional($entrega->data_entrega)->format('Y-m-d\TH:i')) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pendente" {{ old('status', $entrega->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="enviado" {{ old('status', $entrega->status) == 'enviado' ? 'selected' : '' }}>Enviado</option>
                                <option value="entregue" {{ old('status', $entrega->status) == 'entregue' ? 'selected' : '' }}>Entregue</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('entregas.index') }}" class="btn btn-secondary">Voltar</a>
                            <button type="submit" class="btn btn-primary">Atualizar Entrega</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection