<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Venda;
use Illuminate\Http\JsonResponse;

class VendaController extends Controller
{
    protected $vendedor;
    public function __construct(Venda $venda) {
        $this->venda = $venda;
    }

      /**
     * Traz todos as vendas
     */
    public function index()
    {
        $vendas = $this->venda->getAll();

        return view('sales', ['vendas' => $vendas]);
    }

   /**
    * Cria uma nova venda
    */
    public function create(Request $request)
    {   $comissao = (8.5 / 100) * $request->get('total_venda');

        $data = [
            'id_vendedor' => $request->get('seller_id'),
            'total_venda' => $request->get('total_venda'),
            'comissao' => $comissao
        ];

       $record =  $this->venda->create($data);

        if ($record) {
            $response = 'ok';
        } else {
            $response['exception'] = 'Ocorreu um erro ao inserir venda';
        }

        return new JsonResponse($response);
    }
}
