@extends('layouts.main')

@section('style')
    <style>

        #buscarOrdem, .btn-success{
            margin-top:0px !important

        }



        
    </style>
@endsection

@section('title' , 'Cadastrar ordem de serviço')

@section('content')
    
    @if(empty($dadosOrdem))
    <div class='container'> 
        <div class='mt-3'>
            <h1>Buscar ordem por : </h1>
        </div>
        <form method='post' action='/buscar-OS-tipo'>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row mb-3">
                <div class="col-sm-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Pesquisar por: </span>
                        <select  name='tipo_ordem' class="form-control">
                            <option >....</option>
                            <option value='Esperando Orçamento'>Esperando orçamento</option>
                            <option value='Orçamento Pronto'>Orçamento Pronto</option>
                            <option value='Aprovada'>Aprovada</option>
                            <option value='Aprovada AP'>Aprovada AP</option>
                            <option value='Concluido'>Concluido</option>

                        </select>
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
            <h1>Buscar ordem por : </h1>
        </div>
        <form method='post' action='/buscar-OS-tipo'>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row mb-3">
                <div class="col-sm-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Pesquisar por situação: </span>
                        <select  name='tipo_ordem' class="form-control">
                            <option >....</option>
                            <option value='Esperando Orçamento'>Esperando orçamento</option>
                            <option value='Orçamento Pronto'>Orçamento Pronto</option>
                            <option value='Aprovada'>Aprovada</option>
                            <option value='Aprovada AP'>Aprovada AP</option>
                            <option value='Concluido'>Concluido</option>

                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control" id='buscarOrdem'>Buscar</button>
                </div>
            </div>  
        </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ordem</th>
                <th scope="col">Cliente</th>
                <th scope="col">Situação</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dadosOrdem as $row)
                <tr>
                    <td></td>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[2] }}</td>
                    <td>{{ $row[1] }}</td>
                    <td><a class='btn btn-success' href='/consultar/{{ $row[0] }}'>Acessar</a></td>

                <tr>
            
            
            
            @endforeach
           
            
        </tbody>
    </table>


    </div>


    @endif

@endsection