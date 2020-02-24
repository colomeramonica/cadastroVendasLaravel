<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Vendedores;
use Illuminate\Http\JsonResponse;

class VendedorController extends Controller
{
    protected $vendedor;
    public function __construct(Vendedores $vendedor) {
        $this->vendedor = $vendedor;
    }

    /**
     * Cria um novo vendedor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNew(Request $request)
    {
        $data = [
            'nome' => $request->get('seller_name'),
            'email' => $request->get('seller_email')
        ];

       return $this->vendedor->create($data);
    }

    /**
     * Traz todos os vendedores
     */
    public function index()
    {
        $vendedores = $this->vendedor->getAll();

        return view('sellers', ['vendedores' => $vendedores]);
    }

    /**
     * Traz informações de um vendedor
     */
    public function getById(Request $request)
    {
        $id = $request->get('id');
        return $this->vendedor->getById($id);
    }

    /**
     * Apaga um vendedor
     */
    public function remove(Request $request)
    {
        $id = $request->get('id');
        return $this->vendedor->remove($id);
    }

    /**
     * Atualiza um vendedor
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $data = [
            'nome' => $request->get('seller_name'),
            'email' => $request->get('seller_email')
        ];

        return $this->vendedor->renew($id, $data);
    }
}
