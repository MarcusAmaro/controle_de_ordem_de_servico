@extends('layouts.home')
@section('style')
    <style>
        .card {
          background-color: orange;
          transition: transform 0.2s;
          height: 150px;
        }

        .card-nova{
            background-color: lightblue;
        }

        .card-consultar{
            background-color: lightgreen;
        }

        .card-cliente{
            background-color: lightsalmon;
        }


        .card-buscaTipo{
            background-color: lightyellow;
        }

        .card:hover {
          transform: scale(1.05);
        }

        h5, .card-text{
            text-align: center;
            translate:0 40px; 
        }
    </style>
    
@endsection

@section('title' , 'Ordems de serviço')

@section('content')
    
    <div class="container mt-5">
        <div class="row">





          <div class="col-md-6 mb-4">
            <div class="card card-nova" onclick="location.href='/novaOS';" style="cursor: pointer;">
              <div class="card-body">
                <h5 class="card-title">Nova Ordem de Serviço</h5>
                <p class="card-text">Cria nova ordem de serviço</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card card-consultar" onclick="location.href='/consultar';" style="cursor: pointer;">
              <div class="card-body">
                <h5 class="card-title">Consultar Ordem de Serviço</h5>
                <p class="card-text">Consulta uma ordem de serviço</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card card-cliente" onclick="location.href='/dados-cliente';" style="cursor: pointer;">
              <div class="card-body">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text">Cadastra clientes</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card card-buscaTipo" onclick="location.href='/listarOS';" style="cursor: pointer;">
              <div class="card-body">
                <h5 class="card-title">Consulta Detalhada</h5>
                <p class="card-text">Consulta ordem de serviço com parametros</p>
              </div>
            </div>
          </div>
        </div>
    </div>


@endsection