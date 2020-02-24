<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class Vendedores extends Model
{
    protected $fillable = ['nome', 'email'];

    public function getAll()
    {
        try {
            $response = DB::table('vendedores')
            ->leftJoin('vendas', 'vendedores.id', '=', 'vendas.id_vendedor')
            ->select('vendedores.id', 'vendedores.nome', 'vendedores.email', DB::raw('sum(vendas.comissao) as comissao'))
            ->groupBy('vendedores.id','vendedores.nome', 'vendedores.email', 'comissao')
            ->paginate(10);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }

    public function getById($id)
    {
        try {
            $response = DB::table('vendedores')
            ->where('id', '=', $id)
            ->get();
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function getEmails()
    {
        try {
            $response = DB::table('vendedores')
            ->select('vendedores.email')
            ->get();
        } catch(\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }

    public function create($vendedor)
    {
        try {
            $response = DB::table('vendedores')
                ->insert([
                    'nome' => $vendedor['nome'],
                    'email' => $vendedor['email'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

       return new JsonResponse($response);
    }

    public function renew($id, $vendedor)
    {
        try {
            $response = DB::table('vendedores')
                ->where('id', $id)
                ->update([
                    'nome' => $vendedor['nome'],
                    'email' => $vendedor['email'],
                    'updated_at' => now()
                ]);
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function remove($id)
    {
        try {
            $response = DB::table('vendedores')
                ->where('id', '=', $id)
                ->delete();
        } catch (\Exception $e) {
            $response['exception'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }
}
