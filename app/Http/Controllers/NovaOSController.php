<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ordemservico;
use App\Models\cliente;
use App\Models\aparelho;
use App\Models\Produtosordem;
use App\Models\Servicosordem;
use App\Models\Servicos;
use App\Models\Produtos;

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
     
        if(empty($id)){
            $dadosOrdem = ordemservico::where('id',$request->ordemServico)->get();
        }else{
            $dadosOrdem = ordemservico::where('id',$id)->get();
        }
        
        if(!empty($dadosOrdem)){
            foreach($dadosOrdem as $row){ 
                $dadosCliente = cliente::where('id',$row['cli_id'])->get();
                $dadosAparelho = aparelho::where('id',$row['apa_id'])->get();
                $dadosProdutos = Produtosordem::where('id_ordem',$row['id'])->get();
                $dadosServicos = Servicosordem::where('id_ordem',$row['id'])->get();
            }
            $dadosProdutosLista = [];
            if (!empty($dadosProdutos)) {
                foreach ($dadosProdutos as $key) {            
                    $dadosProd = Produtos::where('id',$key->id_produto)->get();
                    foreach ($dadosProd as $linha) {
                        $dadosProdId = $linha->id;
                        $dadosProdNome = $linha->prod_nome;
                        $dadosProdValor = $linha->prod_valor;
                        $listaAux = [$dadosProdId,$dadosProdNome,$dadosProdValor];
                        array_push($dadosProdutosLista, $listaAux);
                    }
                }
            }
            $dadosServicosLista = [];
            if (!empty($dadosServicos)) {
                foreach ($dadosServicos as $key) {            
                    $dadosServ = Servicos::where('id',$key->id_servico)->get();
                    foreach ($dadosServ as $linha) {
                        $dadosServId = $linha->id;
                        $dadosServNome = $linha->serv_nome;
                        $dadosServValor = $linha->serv_valor;
                        $listaAux = [$dadosServId,$dadosServNome,$dadosServValor];
                        array_push($dadosServicosLista, $listaAux);
                    }
                }
            }

            return view('consultar')->with('dadosOrdem',$dadosOrdem)->with('dadosCliente',$dadosCliente)->with('dadosAparelho',$dadosAparelho)->with('dadosProdutos',$dadosProdutosLista)->with('dadosServicos',$dadosServicosLista);
        }else{
            return view('consultar')->with('error404','Ordem nao encontrada');
        }
    }

    public function Consulta_Tipo(Request $request){
        $dadosdaordem = [];
        $dadosOrdem   = DB::table('ordemservicos')
                ->select('ordemservicos.id as numeroOrdem', 'ordemservicos.ord_situacao as Situacao', 'clientes.cli_nome as Cliente', 'aparelhos.apa_tipo as Tipo')
                ->join('aparelhos', 'ordemservicos.apa_id', '=', 'aparelhos.id')
                ->join('clientes', 'ordemservicos.cli_id', '=', 'clientes.id')
                ->where('ordemservicos.ord_situacao', '=', $request->tipo_ordem)
                ->where('ordemservicos.ord_aberto', '=', $request->ordem_abertas)
                ->where('aparelhos.apa_tipo', '=', $request->tipo_Aparelho)
                ->get();

        if(!empty($dadosOrdem)){
            return view('verificarOrdem')->with('dadosOrdem',$dadosOrdem);
        }else{
            return view('verificarOrdem')->with('error404','Ordem nao encontrada com a situação indicada');
        }
    }

    public function Editar(Request $request, $id_OS){
        $jsonprodutosUsadosOrdem    = json_decode($request->produtosUsadosOrdem);
        $jsonservicosPrestadosOrdem = json_decode($request->servicosPrestadosOrdem);

        $jsonProdutosRemovidos = json_decode($request->produtosRemovidosUsadosOrdem);
        $jsonServicosRemovidos = json_decode($request->servicosRemovidosPrestadosOrdem);

        if (!empty($jsonProdutosRemovidos)) {
            foreach($jsonProdutosRemovidos as $key){
                $codigoBusca = intval($key->codigo);
                $confere = DB::table('produtosordems')
                ->where('id_produto', $codigoBusca)
                ->where('id_ordem', $id_OS)
                ->delete();
            }
        }    

        if (!empty($jsonServicosRemovidos)) {
              foreach($jsonServicosRemovidos as $key){
                $codigoBusca = intval($key->codigo);
                $confere = DB::table('servicosordems')
                ->where('id_servico', $codigoBusca)
                ->where('id_ordem', $id_OS)
                ->delete();
            } 
        }   
       
        
        

        if(!empty($request->produtosUsadosOrdem)){ 
            foreach ($jsonprodutosUsadosOrdem as $key) {
                $codigoBusca = intval($key->codigo);
                $confere = DB::table('produtosordems')->select('id_produto as prod, id_ordem as ord')
            ->where('id_produto','=',$codigoBusca)->where('id_ordem','=',$id_OS)->get();

            //se nao existe, realiza o cadastro. Se existe, nao faz nada
                if($confere->count() === 0){
                    $dados              = new Produtosordem;
                    $dados->id_produto  = $codigoBusca;
                    $dados->id_ordem    = $id_OS;
                    $dados->save();
                }
            }
        }

        //confere se existe serviços prestados na ordem
        if(!empty($request->servicosPrestadosOrdem)){
            foreach ($jsonservicosPrestadosOrdem as $key) {
                $codigoBusca = intval($key->codigo);
                $confere = DB::table('servicosordems')->select('id_servico as servic','id_ordem as ord')
            ->where('id_servico', '=', $codigoBusca)->where('id_ordem','=',$id_OS)->get();
                //se nao existe, realiza o cadastro. Se existe, nao faz nada
                if($confere->count() === 0 ){
                    $dados              = new Servicosordem;
                    $dados->id_servico  = $codigoBusca;
                    $dados->id_ordem    = $id_OS;
                    $dados->save();
                }
            }
        }

        $dados = DB::table('ordemservicos')->where('id',$id_OS)
        ->update(
        [
            'ord_relatado_tecnico' => $request->relatadoCliente,
            'ord_situacao'         => $request->situacao,
        ]);
        return view('consultar');
    }
}