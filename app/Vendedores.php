<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vendedores extends Model
{
    protected $fillable = ['nome', 'email'];

    public function getAll()
    {
        $vendedores = DB::table('vendedores')
        ->join('vendas', 'vendedores.id', '=', 'vendas.id_vendedor')
        ->select('vendedor.nome', 'vendedor.email', sum(vendas.comissao))
        ->get();
    }
}
