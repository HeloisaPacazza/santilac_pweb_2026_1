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
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $nomeImagem = null;

        if ($request->hasFile('imagem')) {
            $arquivo = $request->file('imagem');
            $nomeImagem = time() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('imagens'), $nomeImagem);
        }

        Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'peso' => $request->peso,
            'imagem' => $nomeImagem,
        ]);

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
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $nomeImagem = $produto->imagem;

        if ($request->hasFile('imagem')) {
            // Deletar imagem antiga se existir
            if ($produto->imagem && file_exists(public_path('imagens/' . $produto->imagem))) {
                unlink(public_path('imagens/' . $produto->imagem));
            }

            $arquivo = $request->file('imagem');
            $nomeImagem = time() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->move(public_path('imagens'), $nomeImagem);
        }

        $produto->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'estoque' => $request->estoque,
            'peso' => $request->peso,
            'imagem' => $nomeImagem,
        ]);

        return redirect()->route('produtos.index');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
        
    }
 
}
