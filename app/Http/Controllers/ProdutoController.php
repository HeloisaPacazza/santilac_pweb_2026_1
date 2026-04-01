<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $tipo = 'nome';
        $valor = '';
        return view('produtos.index', compact('produtos', 'tipo', 'valor'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor) && !empty($request->tipo)) {
            $produtos = Produto::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $produtos = Produto::all();
        }

        $tipo = $request->input('tipo', 'nome');
        $valor = $request->input('valor', '');
        return view('produtos.index', compact('produtos', 'tipo', 'valor'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'peso' => 'required|numeric',
        ]);

        Produto::create($request->all());
        return redirect()->route('produtos.index');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'peso' => 'required|numeric',
        ]);

        $produto->update($request->all());
        return redirect()->route('produtos.index');
        
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
        
    }
 
}
