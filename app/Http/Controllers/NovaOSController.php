<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ordemservico;
use App\Models\cliente;
use App\Models\aparelho;


class NovaOSController extends Controller
     
{
    public function Post(Request $request){

        //cadastro de um cliente novo

        $dadosCliente = new cliente;
        $dadosCliente->cli_nome = $request->nomeCliente;
        $dadosCliente->cli_cpf = $request->cpfCliente;
        $dadosCliente->cli_endereco = $request->endCLiente;
        $dadosCliente->cli_telefone = $request->telefoneCliente;
        $dadosCliente->cli_telefone2 = '0';
        
        $dadosCliente->save();

        //cadastro do aparelho do cliente

        $idcliente = cliente::where('cli_cpf',$request->cpfCliente)->value('id');
        $dadosAparelho = new aparelho;
        $dadosAparelho->cli_id =  $idcliente;
        $dadosAparelho->apa_tipo = $request->tipoAparelho;
        $dadosAparelho->apa_modelo = $request->modeloAparelho;
        $dadosAparelho->apa_serie = $request->nSerie;
        $dadosAparelho->apa_acessorio = $request->acessoriosAparelho;
        
        $dadosAparelho->save();
        
        //cadastro da ordem de serviço
        
        $apaId = aparelho::where([['cli_id',$idcliente],['apa_serie',$request->nSerie]])->value('id');
        $dados = new ordemservico;
 
        $dados->ord_relatado = $request->relatadoCliente;
        $dados->ord_relatado_tecnico = '';
        $dados->ord_situacao = 'Esperando Orçamento';
        $dados->ord_aberto = '1';
        $dados->cli_id = $idcliente;
        $dados->apa_id = $apaId;
        $dados->save();
        

        

        return view('sucesso',['sucesso'=>'Ordem cadastrada com sucesso'] );

    }



    public function Consulta(Request $request, $id=null){
        
        $dadosdaordem = [];
        
        if(empty($id)){
            $dadosOrdem = ordemservico::where('id',$request->ordemServico)->get();
        }else{
            $dadosOrdem = ordemservico::where('id',$id)->get();
        }
        
        if(!empty($dadosOrdem)){
            foreach($dadosOrdem as $row){

                $teste = $row['ord_relatado'];
    
                $dadosCliente = cliente::where('id',$row['cli_id'])->get();
                $dadosAparelho = aparelho::where('id',$row['apa_id'])->get();
    
            }
    
    
            array_push($dadosdaordem,$dadosOrdem);
            array_push($dadosdaordem,$dadosCliente);
            array_push($dadosdaordem,$dadosAparelho);
    
            return view('consultar')->with('dadosOrdem',$dadosOrdem)->with('dadosCliente',$dadosCliente)->with('dadosAparelho',$dadosAparelho);

        }else{

            return view('consultar')->with('error404','Ordem nao encontrada');


        }
    }



    public function Consulta_Tipo(Request $request){
        $dadosdaordem = [];
        $dadosOrdem = ordemservico::where('ord_situacao','=', $request->tipo_ordem)->where('ord_aberto','=', 1)->get();
        if(!empty($dadosOrdem)){
            foreach($dadosOrdem as $row){

                $dadosCliente = cliente::where('id',$row['cli_id'])->get();
                foreach($dadosCliente as $linha){
                    $listaDados = [$row['id'],$row['ord_situacao'],$linha['cli_nome']];
                }
                
                array_push($dadosdaordem,$listaDados);
 
            }
            return view('verificarOrdem')->with('dadosOrdem',$dadosdaordem);
        }else{
            return view('verificarOrdem')->with('error404','Ordem nao encontrada com a situação indicada');

        }
 
    }




    public function Editar(Request $request, $id_OS){
        $dados = DB::table('ordemservicos')->where('id',$id_OS)
        ->update(
        [
            'ord_relatado_tecnico' => $request->relatadoCliente,
            'ord_situacao' => $request->situacao,

        ]);

    }
}
