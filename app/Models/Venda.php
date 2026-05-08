<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Venda extends Model
{
    protected $fillable = [
        'funcionario_id',
        'total',
        'data_venda',
        'observacoes',
    ];

    protected $casts = [
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id')->withDefault(['nome' => 'Funcionário excluído']);
    }
    // Venda.php
    public function itens()
    {
        return $this->hasMany(Itens_venda::class);
    }
    // Venda.php
public function entrega()
{
    return $this->hasOne(Entrega::class);
}
}