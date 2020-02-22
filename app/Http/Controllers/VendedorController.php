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
        var_dump($request->get('seller_name')); exit;
    }
}
