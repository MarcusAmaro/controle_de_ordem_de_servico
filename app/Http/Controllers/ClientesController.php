<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    //funçao que busca o cliente pelo cpf
    public function Clientepelocpf(Request $request, $cpf=null){
        $dadosOrdem = DB::table('clientes')
        ->select('cli_nome as nome','cli_telefone as telefone', 'cli_telefone2 as telefone2','cli_endereco as endereco')
        ->where('cli_cpf', '=', $cpf)
        ->get();
        
        if(!empty($dadosOrdem)){
            // return view('welcome')->with('dadosOrdem',$dadosOrdem);
            return response()->json($dadosOrdem);
        }
    }

    //chave é o cpf/cnpj ou nome completo do cliente
    public function dadoscompletos(Request $request){
        
        

        $request->validate([
            'nomeoucpf' => 'required|string|max:255',
        ]);

        $chave = $request->input('nomeoucpf');



        // //aqui é buscado os dados do cliente pelo nome completo ou pelo cpf e depois é armazenado seu id
        // //para buscar as ordens de serviço cadastradas com sua id
        if (preg_match('/^\d{10}$/', $chave)) {
            // Busca por CPF
            $dadosCliente = DB::table('clientes')
                ->select('id', 'cli_nome as nome', 'cli_telefone as telefone', 'cli_telefone2 as telefone2', 'cli_endereco as endereco')
                ->where('cli_cpf', '=', $chave)
                ->get();

        }else {
            // Busca por nome
            $dadosCliente = DB::table('clientes')
                ->select('id','cli_nome as nome','cli_telefone as telefone', 'cli_telefone2 as telefone2','cli_endereco as endereco')
                ->where('cli_nome', '=', $chave)
                ->get(); 
        }


        if ($dadosCliente->count() !== 0) {
            
            foreach ($dadosCliente as $key) {
                $id = $key->id;
            
                //após conseguir os dados do cliente, é buscado todas as ordems cadastradas com seu ID
                $dadosOrdem = DB::table('ordemservicos')
                        ->select('id as numeroOrdem','ord_situacao as Situacao','ord_aberto')
                        ->where('cli_id','=', $id)->get();

                if($dadosOrdem->count() !== 0){
                    // return response()->json([
                    //     'dadosOrdem' => $dadosOrdem,
                    //     'dadosCliente' => $dadosCliente
                    // ]);

                    return view('consultarCliente')
                        ->with('dadosOrdem', $dadosOrdem)
                        ->with('dadosCliente', $dadosCliente);
                }else{
                    return response()->json([
                        'dadosOrdem' => 'None',
                        'dadosCliente' => $dadosCliente
                    ]);
                }
            }

        }else{
            return response()->json(['message' => 'Nenhum cliente encontrado'], 404);

        }
        
    }
}
