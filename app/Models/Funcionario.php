<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'carga_horaria'];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
