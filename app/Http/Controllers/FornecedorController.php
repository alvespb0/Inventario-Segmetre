<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    /**
     * Retorna a view de listagem de fornecedores
     */
    public function readFornecedores(){
        $fornecedores = Fornecedor::all();
        return view('/fornecedores/index', ['fornecedores' => $fornecedores]);
    }
}
