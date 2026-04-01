<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Funcionario;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = Venda::with('funcionario')->get();
        $tipo = 'funcionario';
        $valor = '';
        return view('vendas.index', compact('vendas', 'tipo', 'valor'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor) && !empty($request->tipo)) {
            if ($request->tipo === 'funcionario') {
                $vendas = Venda::with('funcionario')->whereHas('funcionario', function ($query) use ($request) { $query->where('nome', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $vendas = Venda::with('funcionario')->where($request->tipo, 'like', '%' . $request->valor . '%')->get();
            }
        } else {
            $vendas = Venda::with('funcionario')->get();
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

        Venda::create([
            'funcionario_id' => $request->funcionario_id,
            'produtos' => json_encode($produtos),
            'total' => $total,
        ]);

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
        $venda = Venda::find($id);
        return view('vendas.edit', compact('venda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'funcionario_id' => 'required',
            'produtos' => 'required|json',
        ]);

        $venda = Venda::find($id);
        $produtos = json_decode($request->produtos, true);
        $total = 0;

        // Calcular total
        foreach ($produtos as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {
                $total += $produto->preco * $item['quantidade'];
            }
        }

        $venda->update([
            'funcionario_id' => $request->funcionario_id,
            'produtos' => json_encode($produtos),
            'total' => $total,
        ]);

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
    
}
