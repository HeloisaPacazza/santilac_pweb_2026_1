<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Venda extends Model
{
    protected $fillable = [
        'funcionario_id',
        'produtos',
        'total',
    ];

    protected $casts = [
        'produtos' => 'json',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }
}