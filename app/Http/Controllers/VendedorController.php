<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as Request;
use App\Vendedores;

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

       $record =  $this->vendedor->addNew($data);
    }

    public function getAll()
    {
        $vendedores = $this->vendedor->getAll();

        return view('sellers', ['vendedores' => $vendedores]);
    }
}
