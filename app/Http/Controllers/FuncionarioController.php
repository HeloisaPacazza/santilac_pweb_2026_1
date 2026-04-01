<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $funcionarios = Funcionario::all();
        $tipo = 'nome';
        $valor = '';
        return view('funcionarios.index', compact('funcionarios', 'tipo', 'valor'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor) && !empty($request->tipo)) {
            $funcionarios = Funcionario::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $funcionarios = Funcionario::all();
        }

        $tipo = $request->input('tipo', 'nome');
        $valor = $request->input('valor', '');
        return view('funcionarios.index', compact('funcionarios', 'tipo', 'valor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'carga_horaria' => 'required|integer'
        ]);

        Funcionario::create($request->all());

        return redirect()->route('funcionarios.index');
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
        $funcionario = Funcionario::find($id);
         return view('funcionarios.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'carga_horaria' => 'required|integer'
        ]);

        $funcionario = Funcionario::find($id);
        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $funcionario = Funcionario::find($id);
         $funcionario->delete();
        return redirect()->route('funcionarios.index');
    }
  
}
