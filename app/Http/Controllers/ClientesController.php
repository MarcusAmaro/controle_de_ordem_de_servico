<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function Clientepelocpf(Request $request, $cpf=null){
        $dadosOrdem = DB::table('clientes')
        ->select('cli_nome as nome','cli_telefone as telefone', 'cli_telefone2 as telefone2','cli_endereco as endereco')
        ->where('cli_cpf', '=', $cpf)
        ->get();

        // if(!empty($dadosOrdem)){
        //     return json_encode($dadosOrdem);
        // }
            if(!empty($dadosOrdem)){
                // return view('welcome')->with('dadosOrdem',$dadosOrdem);
                return response()->json($dadosOrdem);
            }
        
       

    }
}
