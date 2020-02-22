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

        if ($venda == 1) {
            return redirect('/vendas')->with('status', 'success');
        }

        return redirect('/vendas')->with('status', 'failure');
    }
}
