<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    public function getComissao($vendedor)
    {
        $sql = DB::table('vendas')
            ->where('id_vendedor', $vendedor)
            ->sum('comissao');

        return $sql;
    }

    public function addNew($venda)
    {
        $venda = DB::table('vendas')
            ->insert([
                'id_vendedor' => $venda['vendedor'],
                'total_venda' => $venda['total'],
                'comissao' => $venda['comissao']
            ]);

        if ($venda) {
            return true;
        }

        return false;
    }

    public function getAll()
    {
        $vendedores = DB::table('vendas')
        ->leftJoin('vendedores', 'vendedores.id', '=', 'vendas.id_vendedor')
        ->select('vendas.id', 'vendas.total_venda', 'vendedores.nome')
        ->groupBy('vendas.id','vendas.total_venda', 'vendedores.nome')
        ->paginate(10);

        return $vendedores;
    }

    public function create($venda)
    {
        $venda = DB::table('vendas')
            ->insert([
                'id_vendedor' => $venda['id_vendedor'],
                'total_venda' => $venda['total_venda'],
                'comissao' => $venda['comissao'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        if ($venda) {
            return true;
        }

        return false;
    }
}
