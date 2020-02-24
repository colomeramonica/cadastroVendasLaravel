<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request as Request;
use App\Venda;
use App\Vendedores as Vendedores;
use Illuminate\Http\JsonResponse;

class VendaController extends Controller
{
    protected $vendedor;
    public function __construct(Venda $venda, Vendedores $vendedores) {
        $this->venda = $venda;
        $this->vendedores = $vendedores;
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

       return $this->venda->create($data);
    }

    public function getSellers()
    {
        return $this->vendedores->getAll();
    }

    public function mail()
    {
        $emails = $this->vendedores->getEmails();
        $vendas = $this->venda->retrieveSales();

        foreach ($emails as $email) {
            Mail::to($email)->send(new SendMail($vendas));
        }
    }
}
