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
            ->sum();

        return $sql;
    }
}
