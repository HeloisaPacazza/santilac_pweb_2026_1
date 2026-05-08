<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venda;
use App\Models\Produto;


class Itens_venda extends Model
{
    /** @use HasFactory<\Database\Factories\ItensVendaFactory> */
    use HasFactory;
    protected $fillable = ['venda_id','produto_id','quantidade','preco_unitario','subtotal'];
    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
// ItemVenda.php
