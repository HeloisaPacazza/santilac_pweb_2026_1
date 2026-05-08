<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Funcionario;
use App\Models\Itens_venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = Venda::with('funcionario', 'itens.produto')->get();
        $tipo = 'funcionario';
        $valor = '';
        return view('vendas.index', compact('vendas', 'tipo', 'valor'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor) && !empty($request->tipo)) {
            if ($request->tipo === 'funcionario') {
                $vendas = Venda::with('funcionario', 'itens.produto')->whereHas('funcionario', function ($query) use ($request) { $query->where('nome', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $vendas = Venda::with('funcionario', 'itens.produto')->where($request->tipo, 'like', '%' . $request->valor . '%')->get();
            }
        } else {
            $vendas = Venda::with('funcionario', 'itens.produto')->get();
        }

        $tipo = $request->input('tipo', 'funcionario');
        $valor = $request->input('valor', '');
        return view('vendas.index', compact('vendas', 'tipo', 'valor'));
    }    
    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $produtos = Produto::all();
        $funcionarios = Funcionario::all();

        return view('vendas.create', compact('produtos', 'funcionarios'))
        ->with('success', 'Formulário de venda carregado com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required',
            'produtos' => 'required|json',
            'data_venda' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $produtos = json_decode($request->produtos, true);
        $total = 0;

        // Calcular total
        foreach ($produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {
                $total += $produto->preco * $item['quantidade'];
            }
        }

        $venda = Venda::create([
            'funcionario_id' => $request->funcionario_id,
            'total' => $total,
            'data_venda' => $request->data_venda,
            'observacoes' => $request->observacoes,
        ]);

        // Criar itens da venda
        foreach ($produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {
                Itens_venda::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $produto->preco * $item['quantidade'],
                ]);
            }
        }

        return redirect()->route('vendas.index')
            ->with('success', 'Venda criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venda = Venda::with('itens.produto')->findOrFail($id);
        $produtos = Produto::all();

        return view('vendas.edit', compact('venda', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'funcionario_id' => 'required',
            'produtos' => 'required|json',
            'data_venda' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $venda = Venda::findOrFail($id);
        $produtos = json_decode($request->produtos, true);
        $total = 0;

        foreach ($produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {
                $total += $produto->preco * $item['quantidade'];
            }
        }

        $venda->update([
            'funcionario_id' => $request->funcionario_id,
            'total' => $total,
            'data_venda' => $request->data_venda,
            'observacoes' => $request->observacoes,
        ]);

        Itens_venda::where('venda_id', $venda->id)->delete();

        foreach ($produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {
                Itens_venda::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $produto->preco * $item['quantidade'],
                ]);
            }
        }

        return redirect()->route('vendas.index')
            ->with('success', 'Venda atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venda = Venda::find($id);
        $venda->delete();
        return redirect()->route('vendas.index')
        ->with('success', 'Venda excluída com sucesso!');
    }
    
    public function relatorio()
    {
        $dados = Venda::with('cliente')->get();

        $pdf = PDF::loadView('relatorios.vendas', compact('dados'));

        return $pdf->download('relatorio.pdf');
    }
}
