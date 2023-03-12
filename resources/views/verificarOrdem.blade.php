@extends('layouts.main')

@section('style')
    <style>

        #buscarOrdem, .btn-success{
            margin-top:0px !important

        }


        .posicionamento{
            position:fixed;
            top:40%;
            left:80%;
            transform:translate(-50%,-80%)
            
        }
        label{
            padding-right : 10px


        }
        /* #pesqSitu,#pesqAbertas,#pesqtip{
            visibility:hidden
        } */


    </style>

    <script>
       function testeF(tipo){
            console.log(tipo)
            if (tipo == 'situacao'){   
                document.getElementById('pesqSitu').style.visibility = 'visible';             
                document.getElementById('pesqAbertas').style.visibility = 'hidden';
                document.getElementById('pesqtip').style.visibility = 'hidden';

            }
            if(tipo == 'abertos'){
                document.getElementById('pesqAbertas').style.visibility = 'visible';
                document.getElementById('pesqSitu').style.visibility = 'hidden';             
                document.getElementById('pesqtip').style.visibility = 'hidden';
            }
            
            if(tipo == 'tipoaparelho'){
                document.getElementById('pesqtip').style.visibility = 'visible';
                document.getElementById('pesqAbertas').style.visibility = 'hidden';
                document.getElementById('pesqSitu').style.visibility = 'hidden';             
                
            }
            
       }
    </script>
@endsection

@section('title' , 'Cadastrar ordem de serviço')

@section('content')
    
    @if(empty($dadosOrdem) )
    
    <div class='container'> 
    <div class='mt-3'>
        <div class = 'row'>
            <div class = 'col-4'>
                <h1 class =''>Buscar ordem por: </h1>
            </div>    

        </div>
    </div>
    <div class ='col-sm-10'>
        <!-- pesquisar por situaçao -->
        <form method='post' action='/buscar-OS-tipo' id='pesqSitu'>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row ">
                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6 "  >
                            <span class="input-group-text" id="basic-addon3">Pesquisar por situação: </span>
                            <select  name='tipo_ordem' class="form-control">
                                <option >....</option>
                                <option value='Esperando'>Esperando orçamento</option>
                                <option value='Orçamento Pronto'>Orçamento Pronto</option>
                                <option value='Aprovada'>Aprovada</option>
                                <option value='Aprovada AP'>Aprovada AP</option>
                                <option value='Concluido'>Concluido</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6">
                            <span class="input-group-text" id="basic-addon3">Ordens Abertas: </span>
                            <select  name='ordem_abertas' class="form-control">
                                <option >....</option>
                                <option value='1'>Ordens Abertas</option>
                                <option value='2'>Ordens Fechadas</option>
                            </select>
                        </div>
                    </div>
                    
                </div>  


                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6">
                            <span class="input-group-text" id="basic-addon3">Pesquisar por tipo de aparelho: </span>
                            <select  name='tipo_Aparelho' class="form-control">
                                <option >....</option>
                                <option value='Notebooks'>Notebook</option>
                                <option value='Impressora'>Impressora</option>
                                <option value='Nobreak'>Nobreak</option>
                                <option value='Celular'>Celular</option>
                                <option value='Monitor'>Monitor</option>

                            </select>
                        </div>
                    </div>
                    
                </div>  


                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar</button>
                </div>
            </div>  
        </form>

    </div>

    
    @else
    
    <div class='container'>


    <div class='mt-3'>
        <div class = 'row'>
            <div class = 'col-4'>
                <h1 class =''>Buscar ordem por: </h1>
            </div>    

        </div>
    </div>
    <div class ='col-sm-10'>
        <!-- pesquisar por situaçao -->
        <form method='post' action='/buscar-OS-tipo' id='pesqSitu'>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row ">
                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6 "  >
                            <span class="input-group-text" id="basic-addon3">Pesquisar por situação: </span>
                            <select  name='tipo_ordem' class="form-control">
                                <option >....</option>
                                <option value='Esperando'>Esperando orçamento</option>
                                <option value='Orçamento Pronto'>Orçamento Pronto</option>
                                <option value='Aprovada'>Aprovada</option>
                                <option value='Aprovada AP'>Aprovada AP</option>
                                <option value='Concluido'>Concluido</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6">
                            <span class="input-group-text" id="basic-addon3">Ordens Abertas: </span>
                            <select  name='ordem_abertas' class="form-control">
                                <option >....</option>
                                <option value=1>Ordens Abertas</option>
                                <option value=2>Ordens Fechadas</option>
                            </select>
                        </div>
                    </div>
                    
                </div>  


                <div class="row mb-3">
                    <div class="col-sm-5">
                        <div class="input-group mb-6">
                            <span class="input-group-text" id="basic-addon3">Pesquisar por tipo de aparelho: </span>
                            <select  name='tipo_Aparelho' class="form-control">
                                <option >....</option>
                                <option value='Notebooks'>Notebook</option>
                                <option value='Impressora'>Impressora</option>
                                <option value='Nobreak'>Nobreak</option>
                                <option value='Celular'>Celular</option>
                                <option value='Monitor'>Monitor</option>

                            </select>
                        </div>
                    </div>
                    
                </div>  


                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar</button>
                </div>
            </div>  
        </form>

    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ordem</th>
                <th scope="col">Situação</th>
                <th scope="col">Cliente</th>
                <th scope="col">Tipo</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dadosOrdem as $row)
                
                <tr>
                    <td></td>
                    <td>{{ $row->numeroOrdem }}</td>
                    <td>{{ $row->Situacao }}</td>
                    <td>{{ $row->Cliente }}</td>
                    <td>{{ $row->Tipo }}</td>
                    <td><a class='btn btn-success' href='/consultar/{{ $row->numeroOrdem }}'>Acessar</a></td>

                <tr>

              
            
            
            
            @endforeach
           
            
        </tbody>
    </table>


    </div>


    @endif

@endsection