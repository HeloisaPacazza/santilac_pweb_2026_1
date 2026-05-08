<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Venda;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $entregas = Entrega::with('venda')
            ->when($busca, function ($query) use ($busca) {
                $query->where('endereco', 'like', "%$busca%")
                    ->orWhere('cidade', 'like', "%$busca%");
            })
            ->get();

        return view('entregas.index', compact('entregas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendas = Venda::all();
        return view('entregas.create', compact('vendas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venda_id' => 'required|unique:entregas,venda_id',
            'endereco' => 'required',
            'cidade' => 'required',
            'data_entrega' => 'required|date',
            'status' => 'required'
        ]);

        Entrega::create($request->all());

        return redirect()->route('entregas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        $vendas = Venda::all();
        return view('entregas.edit', compact('entrega', 'vendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        $request->validate([
            'venda_id' => 'required|unique:entregas,venda_id,' . $entrega->id,
            'endereco' => 'required',
            'cidade' => 'required',
            'data_entrega' => 'nullable|date',
            'status' => 'required'
        ]);

        $data = $request->all();

        // Se data_entrega não foi enviada ou está vazia, mantém a atual
        if (empty($data['data_entrega'])) {
            unset($data['data_entrega']);
        }

        $entrega->update($data);

        return redirect()->route('entregas.index')
            ->with('success', 'Entrega atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        $entrega->delete();
        return redirect()->route('entregas.index')
            ->with('success', 'Entrega excluída com sucesso!');
    }
}
