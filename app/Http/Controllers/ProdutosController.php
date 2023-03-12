<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    public function produtosUsados(Request $request, $nome=null){
        $dadosOrdem = DB::table('produtos')
        ->select('id as codigo', 'prod_nome as produto','prod_valor as valor')
        ->where('prod_nome', 'like', "%$nome%")
        ->get();

        if(!empty($dadosOrdem)){
            return response()->json($dadosOrdem);
        }
        
       

    }

    public function adicionaProdutoID(Request $request,$codigo=null){
        $dadosOrdem = DB::table('produtos')
        ->select('prod_nome as produto','prod_valor as valor')
        ->where('id', '=', "$codigo")
        ->get();

        if(!empty($dadosOrdem)){ 
            return response()->json($dadosOrdem);
        }
    }
}
