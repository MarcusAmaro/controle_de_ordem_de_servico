@extends('layouts.main')

@section('style')
    <style>

        #buscarOrdem, .gravar-ordem{
            margin-top:0px !important

        }

        td,th{
            vertical-align: middle;
        }

        .pesquisa-prod{
            display: flex;
            align-items: center;
            margin-left:auto;
            margin-right : auto
        }
        th,td,#alerta{
            text-align:center    
            
        }
        .buscaProdutos{
            flex: 1;
            margin-right: 10px;
        }

    </style>
@endsection

@section('title' , 'Buscar dados completos do cliente')

@section('content')

    @if(empty($dadosOrdem))
        <div class='container'>
            
            <div class="mt-3">
                <h1>Buscar Dados completos dos clientes </h1>
            </div>

            <form method='post' action='/consultarCliente'>
                @csrf <!-- {{ csrf_field() }} -->
                <div class="row mb-3">
                    <label for="ordemServico" class="col-sm-2 col-form-label">Buscar dados do cliente:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nomeoucpf" name="nomeoucpf" placeholder="Digite o nome ou cpf para consulta">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar</button>
                    </div>
                    
                </div>
            </form>
        </div>
    @else

        <div class='container'>

            <div class="mt-3">
                <h1>Buscar Dados completos dos clientes </h1>
            </div>
            
            <form method='post' action='/buscar-OS'>
                @csrf <!-- {{ csrf_field() }} -->
                <div class="row mb-3">
                    <label for="ordemServico" class="col-sm-2 col-form-label">Buscar dados do cliente:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nomeoucpf" name="nomeoucpf" placeholder="Digite o nome ou cpf para consulta">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar</button>
                    </div>
                    
                </div>
            </form>

            <table class="table">
        <thead>
            <tr>
             
                <th scope="col">Ordem</th>
                <th scope="col">Situação</th>
                <th scope="col">Cliente</th>
                
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $cli = $dadosCliente->get(0);
                $cliente = $cli->nome;
            ?>

            @foreach($dadosOrdem as $row)
               
                <tr>
                    
                    <td>{{ $row->numeroOrdem }}</td>
                    <td>{{ $row->Situacao }}</td>
                    <td>{{ $cliente }}</td>
                    
                    <td><a class='btn btn-success' href='/consultar/{{ $row->numeroOrdem }}'>Acessar</a></td>

                <tr>

            @endforeach
           
            
        </tbody>
    </table>

        </div>
    </div>
       
    @endif

@endsection