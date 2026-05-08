<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    /** @use HasFactory<\Database\Factories\EntregaFactory> */
    use HasFactory;
    protected $fillable = ['venda_id', 'endereco', 'cidade', 'status', 'data_entrega'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
// Entrega.php
