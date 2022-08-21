@extends('layouts.main')

@section('style')
    <style>

        #buscarOrdem, .gravar-ordem{
            margin-top:0px !important

        }

        
    </style>
@endsection

@section('title' , 'Cadastrar ordem de serviço')

@section('content')

    @if(empty($dadosOrdem))
        <div class='container'>
            
            <div class="mt-3">
                <h1>Buscar Ordem: </h1>
            </div>

            <form method='post' action='/buscar-OS'>
                @csrf <!-- {{ csrf_field() }} -->
                <div class="row mb-3">
                    <label for="ordemServico" class="col-sm-2 col-form-label">Ordem de Serviço:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ordemServico" name="ordemServico" placeholder="Numero para consulta">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar OS</button>
                    </div>
                    
                </div>

            
                
            </form>
    </div>
    
      
    @else
       

       





        <div class='container'>
        <form method='post' action='/buscar-OS'>
                @csrf <!-- {{ csrf_field() }} -->
            <div class = 'row mt-3'>
                <div class="col-md-4">
                    <h1>Consultar Ordem</h1>
                </div>

                <div class="col-md-3">
                    
                </div>
                
                <div class="col-md-4 mt-2">
                    <div class='row'>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ordemServico" name="ordemServico" placeholder="Numero para consulta">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar OS</button>
                        </div>
                    </div>
                </div>
    

            </div>
            </form>




        <!-- {{ $dadosOrdem }}
        {{ $dadosCliente }}
        {{ $dadosAparelho }} -->
        <div class = 'row'>
            <div class="col-md-6">
                @foreach($dadosCliente as $row)
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Cliente : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->cli_nome }}" readonly>
                </div>

                @endforeach
            </div>

            <div class="col-md-5">
                @foreach($dadosOrdem  as $row)
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon3">Ordem : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->id}}" readonly>
                </div>

                @endforeach
            </div>

        </div>

        <div class = 'row'>
            <div class="col-md-11">
                @foreach($dadosAparelho as $row)
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Acessorios : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->apa_acessorio }}" readonly>
                </div>

                @endforeach
            </div>

            

        </div>
        


        <div class = 'row'>
            <div class="col-md-2">
                @foreach($dadosAparelho as $row)
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Modelo : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->apa_modelo }}" readonly>
                </div>

                @endforeach
            </div>

            <div class="col-md-2">
                @foreach($dadosAparelho  as $row)
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Serie : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->apa_serie}}" readonly>
                </div>

                @endforeach
            </div>

            <div class="col-md-2">
                @foreach($dadosAparelho  as $row)
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Serie : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->apa_tipo}}" readonly>
                </div>

                @endforeach
            </div>

        </div>





        @foreach($dadosOrdem as $row)
        <form method='post' action='/Salvar-os/{{ $row->id }}'>
        @method('PUT')
        @csrf <!-- {{ csrf_field() }} -->   
        <div class="row g-5">      
            <div class="col-md-6">
                <h3>Relatado pelo cliente</h3>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="relatadoCliente" rows="20" name='relatadoCliente' readonly>{{ $row->ord_relatado }}</textarea>
                    </div>  
            </div>

            <div class="col-md-6">
                <h3>Orçamento do tecnico</h3>            
                    <div class="col-sm-10">
                        <textarea class="form-control" id="relatadoCliente" rows="20" name='relatadoCliente'>{{ $row->ord_relatado_tecnico }}</textarea>
                    </div> 
            </div>       
        </div>


        <div class = 'row mt-4'>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Situação atual : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ $row->ord_situacao }}" readonly>
                </div>
            </div>

        </div>
        
        <div class = 'row mt-4'>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Nova situação : </span>
                    <select  name='situacao' class="form-control">
                        <option >....</option>
                        <option value='Esperando Orçamento'>Esperando orçamento</option>
                        <option value='Orçamento Pronto'>Orçamento Pronto</option>
                        <option value='Aprovada'>Aprovada</option>
                        <option value='Aprovada AP'>Aprovada AP</option>

                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary gravar-ordem">Salvar nova OS</button>
            </div>

        </div>

        </form>

        @endforeach



    </div>
       
    @endif

@endsection