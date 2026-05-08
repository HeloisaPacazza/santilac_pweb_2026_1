<?php

namespace App\Http\Controllers;

use App\Models\Itens_venda;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Http\Request;


class ItensVendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $itens = Itens_venda::with('produto', 'venda')
            ->when($busca, function ($query) use ($busca) {
                $query->whereHas('produto', function ($q) use ($busca) {
                    $q->where('nome', 'like', "%$busca%");
                });
            })
            ->get();

        return view('itens.index', compact('itens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendas = Venda::all();
        $produtos = Produto::all();

        return view('itens.create', compact('vendas', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venda_id' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric'
        ]);

        $subtotal = $request->quantidade * $request->preco_unitario;

        Itens_venda::create([
            'venda_id' => $request->venda_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'preco_unitario' => $request->preco_unitario,
            'subtotal' => $subtotal
        ]);

        return redirect()->route('itens.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Itens_venda $itens_venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Itens_venda $itens_venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itens_venda $itens_venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itens_venda $itens_venda)
    {
        //
    }
}
