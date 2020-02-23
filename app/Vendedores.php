<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vendedores extends Model
{
    protected $fillable = ['nome', 'email'];

    public function getAll()
    {
        $vendedores = DB::table('vendedores')
        ->leftJoin('vendas', 'vendedores.id', '=', 'vendas.id_vendedor')
        ->select('vendedores.id', 'vendedores.nome', 'vendedores.email', DB::raw('sum(vendas.comissao) as comissao'))
        ->groupBy('vendedores.id','vendedores.nome', 'vendedores.email', 'comissao')
        ->paginate(10);

        return $vendedores;
    }

    public function getById($id)
    {
        $vendedor = DB::table('vendedores')
        ->where('id', '=', $id)
        ->get();

        return $vendedor;
    }

    public function create($vendedor)
    {
        $vendedor = DB::table('vendedores')
            ->insert([
                'nome' => $vendedor['nome'],
                'email' => $vendedor['email'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        if ($vendedor) {
            return true;
        }

        return false;
    }

    public function remove($id)
    {
        $vendedor = DB::table('vendedores')
            ->where('id', '=', $id)
            ->delete();

        if ($vendedor) {
            return true;
        }

        return false;
    }

    public function update($id, $vendedor)
    {
        $vendedor = DB::table('vendedores')
            ->where('id', '=', $id)
            ->update([
                'nome' => $vendedor['nome'],
                'email' => $vendedor['email'],
                'updated_at' => now()
            ]);

        if ($vendedor) {
            return true;
        }

        return false;
    }
}
