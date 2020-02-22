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
        ->select('vendedores.id', 'vendedores.nome', 'vendedores.email', DB::raw('sum(vendas.comissao) as comissao'))
        ->groupBy('vendedores.id','vendedores.nome', 'vendedores.email', 'comissao')
        ->paginate(10);

        return $vendedores;
    }

    public function addNew($vendedor)
    {
        $vendedor = DB::table('vendedores')
            ->insert([
                'nome' => $vendedor['nome'],
                'email' => $vendedor['email']
            ]);

        if ($vendedor == 1) {
            return redirect('/vendedores')->with('status', 'success');
        }

        return redirect('/vendedores')->with('status', 'failure');
    }
}
