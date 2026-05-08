@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Nova Venda</h2>

    <form method="POST" action="{{ route('vendas.store') }}" onsubmit="prepareProdutos(event)">
        @csrf

        <div class="mb-3">
            <label for="funcionario_id" class="form-label">Funcionário</label>
            <select name="funcionario_id" id="funcionario_id" class="form-control" required>
                <option value="">Selecione um funcionário</option>
                @foreach($funcionarios as $f)
                    <option value="{{ $f->id }}">{{ $f->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data_venda" class="form-label">Data da Venda</label>
            <input type="datetime-local" class="form-control" id="data_venda" name="data_venda">
        </div>

        <div class="mb-3">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
        </div>

        <h4>Produtos</h4>
        <div id="produtos-container">
            <div class="produto-row mb-3 p-3 border">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Produto</label>
                            <select class="form-control produto-select" required>
                            <option value="">Selecione um produto</option>
                            @foreach($produtos as $p)
                                <option value="{{ $p->id }}" data-preco="{{ $p->preco }}">{{ $p->nome }} (R$ {{ number_format($p->preco, 2, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quantidade</label>
                        <input type="number" class="form-control quantidade-input" value="1" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Subtotal</label>
                        <input type="text" class="form-control subtotal-display" value="R$ 0,00" disabled>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removerProduto(this)">Remover</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="adicionarProduto()">+ Adicionar Produto</button>

        <div class="alert alert-info">
            <strong>Total: </strong>
            <span id="total-display">R$ 0,00</span>
        </div>

        <input type="hidden" name="produtos" id="produtos-json">

        <button type="submit" class="btn btn-success">Salvar Venda</button>
    </form>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<script>
function formatarMoeda(valor) {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
}

function adicionarProduto() {
    const container = document.getElementById('produtos-container');
    const html = `
        <div class="produto-row mb-3 p-3 border">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Produto</label>
                    <select class="form-control produto-select" required>
                        <option value="">Selecione um produto</option>
                        @foreach($produtos as $p)
                            <option value="{{ $p->id }}" data-preco="{{ $p->preco }}">{{ $p->nome }} (R$ {{ number_format($p->preco, 2, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantidade</label>
                    <input type="number" class="form-control quantidade-input" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Subtotal</label>
                    <input type="text" class="form-control subtotal-display" value="R$ 0,00" disabled>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removerProduto(this)">Remover</button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    attachEventListeners();
}

function removerProduto(btn) {
    btn.closest('.produto-row').remove();
    calcularTotal();
}

function attachEventListeners() {
    const selects = document.querySelectorAll('.produto-select');
    const inputs = document.querySelectorAll('.quantidade-input');

    selects.forEach(select => {
        select.addEventListener('change', calcularTotal);
    });

    inputs.forEach(input => {
        input.addEventListener('input', calcularTotal);
    });
}

function calcularTotal() {
    let total = 0;
    document.querySelectorAll('.produto-row').forEach(row => {
        const select = row.querySelector('.produto-select');
        const quantidade = parseInt(row.querySelector('.quantidade-input').value) || 0;
        const preco = parseFloat(select.options[select.selectedIndex].dataset.preco) || 0;
        const subtotal = preco * quantidade;

        row.querySelector('.subtotal-display').value = formatarMoeda(subtotal);
        total += subtotal;
    });

    document.getElementById('total-display').textContent = formatarMoeda(total);
}

function prepareProdutos(event) {
    const produtos = [];
    let valido = true;

    document.querySelectorAll('.produto-row').forEach(row => {
        const id = row.querySelector('.produto-select').value;
        const quantidade = parseInt(row.querySelector('.quantidade-input').value);

        if (!id || !quantidade) {
            valido = false;
            return;
        }

        produtos.push({ id: parseInt(id), quantidade: quantidade });
    });

    if (!valido || produtos.length === 0) {
        event.preventDefault();
        alert('Por favor, preencha todos os produtos com quantidade válida');
        return;
    }

    document.getElementById('produtos-json').value = JSON.stringify(produtos);
}

// Inicializar event listeners
document.addEventListener('DOMContentLoaded', () => {
    attachEventListeners();
    calcularTotal();
});
</script>

@endsection