<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicosController extends Controller
{
    public function servicosUsados(Request $request, $nome=null){
        $dadosOrdem = DB::table('servicos')
        ->select('id as codigo', 'serv_nome as servico','serv_valor as valor')
        ->where('serv_nome', 'like', "%$nome%")
        ->get();

        if(!empty($dadosOrdem)){
            return response()->json($dadosOrdem);
        }
    }



    public function adicionaServicoID(Request $request,$codigo=null){
        $dadosOrdem = DB::table('servicos')
        ->select('serv_nome as servico','serv_valor as valor')
        ->where('id', '=', "$codigo")
        ->get();

        if(!empty($dadosOrdem)){ 
            return response()->json($dadosOrdem);
        }
    }
}
