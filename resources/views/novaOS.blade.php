

<!-- Formulario de nova OS -->
@extends('layouts.main')



@section('title' , 'Cadastrar ordem de serviço')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class='container'>
      
        <div class="col-md-6 mt-3">
            <h1>Criar nova ordem de serviço</h1>
        </div>
        

        <form method='post' action='/novaOS/cadastrar'>
        @csrf <!-- {{ csrf_field() }} -->
        <h3>Relatado pelo cliente</h3>
            <div class="row mb-3">
                <label for="relatadoCliente"  class="col-sm-2 col-form-label">Relatado</label>
                <div class="col-sm-10">
                <textarea class="form-control" id="relatadoCliente" rows="9" name='relatadoCliente'></textarea>
                </div>
            </div>



            <h3>Dados do Aparelho</h3>
            <div class="row mb-3">
                <label for="tipoAparelho" class="col-sm-2 col-form-label">Tipo do aparelho</label>
                <div class="col-sm-10">
                <select id="tipoAparelho" name='tipoAparelho' class="form-control">
                    <option selected>...</option>
                    <option value='Notebooks'>Notebooks</option>
                    <option value='Computador'>Computador</option>
                    <option value='Impressora'>Impressora</option>
                    <option value='Nobreak'>Nobreak</option>

                </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="modeloAparelho" class="col-sm-2 col-form-label">Modelo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modeloAparelho" name="modeloAparelho" placeholder="Modelo do aparelho">
                </div>
            </div>

            <div class="row mb-3">
                <label for="nSerie" class="col-sm-2 col-form-label">N° Serie</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nSerie" name="nSerie" placeholder="Modelo do aparelho">
                </div>
            </div>

            <div class="row mb-3">
                <label for="acessoriosAparelho" class="col-sm-2 col-form-label">Acessorios:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="acessoriosAparelho" name="acessoriosAparelho" placeholder="Modelo do aparelho">
                </div>
            </div>

            
            <h3>Dados do cliente</h3>

            <div class="row mb-3 mt-8" >
                
                <label for="nomeCliente" class="col-sm-2 col-form-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nomeCliente' id="nomeCliente" placeholder="Nome completo do cliente">
                </div>
            </div>

            <div class="row mb-3">
                <label for="telefoneCliente" class="col-sm-2 col-form-label">Telefone:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telefoneCliente" name='telefoneCliente' placeholder="Telefone do cliente">
                </div>
            </div>

            <div class="row mb-3">
                <label for="telefoneCliente2" class="col-sm-2 col-form-label">Telefone 2:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telefoneCliente2"  name="telefoneCliente2"   placeholder="Caso cliente tenha outro número">
                </div>
            </div>

            <div class="row mb-3">
                <label for="cpfCliente" class="col-sm-2 col-form-label">Cpf:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cpfCliente"  name='cpfCliente'  placeholder="Cpf do cliente">
                </div>
            </div>

            <div class="row mb-3">
                <label for="endCLiente" class="col-sm-2 col-form-label">Endereço do cliente:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="endCLiente" name='endCLiente' placeholder="Endereço do cliente">
                </div>
            </div>

           
            <button type="submit" class="btn btn-primary ">Salvar nova OS</button>
        </form>
        
</div>
  

@endsection
