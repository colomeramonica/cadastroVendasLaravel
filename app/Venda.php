<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    public function addNew($venda)
    {
        try {
            $response = DB::table('vendas')
                ->insert([
                    'id_vendedor' => $venda['vendedor'],
                    'total_venda' => $venda['total'],
                    'comissao' => $venda['comissao']
                ]);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function getAll()
    {
        try {
            $response = DB::table('vendas')
            ->leftJoin('vendedores', 'vendedores.id', '=', 'vendas.id_vendedor')
            ->select('vendas.id', 'vendas.total_venda', 'vendedores.nome')
            ->groupBy('vendas.id','vendas.total_venda', 'vendedores.nome')
            ->paginate(10);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }

    public function create($venda)
    {
        try {
            $response = DB::table('vendas')
                ->insert([
                    'id_vendedor' => $venda['id_vendedor'],
                    'total_venda' => $venda['total_venda'],
                    'comissao' => $venda['comissao'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function retrieveSales()
    {
        try {
            $response = DB::table('vendas')
            ->where('created_at', DB::raw('Date(created_at)=Curdate()'))
            ->get();

        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }
}
