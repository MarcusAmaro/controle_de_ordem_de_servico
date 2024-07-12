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

@section('title' , 'Cadastrar ordem de serviço')

@section('content')

    @if(empty($dadosOrdem))
        <div class='container'>
            
            <div class="mt-3">
                <h1>Buscar cliente </h1>
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
        </div>
    @else

        <div class='container'>
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
                        <textarea class="form-control" id="relatadoCliente" rows="10" name='relatadoCliente' readonly>{{ $row->ord_relatado }}</textarea>
                    </div>  
            </div>

            <div class="col-md-6">
                <h3>Orçamento do tecnico</h3>            
                    <div class="col-sm-10">
                        <textarea class="form-control" id="relatadoCliente" rows="10" name='relatadoCliente'>{{ $row->ord_relatado_tecnico }}</textarea>
                    </div> 
            </div>       
        </div>

        <!-- Modal Produtos-->
        <div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="modalProdutosTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Produtos Usados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">
                    <div class="produtos-usados" id='produtos-usados'>
                        
                        <div class ='pesquisa-prod w-75 align-items-center '>
                            <input type='text' class ='buscaProdutos' id='buscaProdutos'/>
                            <button type='button' class = 'btn btn-primary' onclick=produtosUsados()>Procurar</button>
                        </div>
                        
                        <div class='container-tabela' id='container-tabela'>


                        </div>
                       


                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Produtos-->

        <!-- Modal Serviços-->
        <div class="modal fade" id="modalServicos" tabindex="-1" role="dialog" aria-labelledby="modalServicosTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Serviços Prestados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">
                        <div class="servicos-prestados" id='servicos-prestados'>
                            
                            <div class ='pesquisa-prod w-75 align-items-center '>
                                <input type='text' class ='buscaServicos' id='buscaServicos'/>
                                <button type='button' class = 'btn btn-primary' onclick=servicosPrestados()>Procurar</button>
                            </div>
                            
                            <div class='container-tabela-servicos' id='container-tabela-servicos'>


                            </div>
                        


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Serviços-->

        <div class="row g-5">      
            <div class="col-md-4">
                <!-- Botao Modal Produtos-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProdutos">
                    Produtos Usados
                </button>
                <!-- Botao Modal Produtos-->

        

                <div class='pecas-usadas mb-3' id='pecas-usadas'>
                    <h3 class='mb-4'>Produtos Usados</h3>
                    <div id = 'lista-produtos-usados'>
                        <table class = "table " id='produtos-usados-table'>
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Ação</th>
                                <tr>
                            <thead>
                            <tbody id='produtos-usados-tbody'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Botao Modal Serviços-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalServicos">
                    Serviços Prestados
                </button>
                <!-- Botao Modal Serviços-->
                <div class='pecas-usadas mb-3' id='pecas-usadas'>
                    <h3 class='mb-4'>Serviços Prestados</h3>
                    <div id = 'lista-servicos-prestados'>
                        <table class = "table " id='servicos-prestados-table'>
                            <thead>
                                <th>Serviços</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </thead>
                            <tbody id='servicos-prestados-tbody'>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class = 'row mt-4'>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Valor da Ordem: </span>
                    <input type="text" class="form-control" id="valorAtual" aria-describedby="basic-addon3" value="" readonly>
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
        </div>

        <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-primary gravar-ordem">Salvar nova OS</button>
        </div>

        </form>

        @endforeach

            <script>
                $('#myModal').on('shown.bs.modal', function () {
                    $('#myInput').trigger('focus')
                })
            
                function produtosUsados() {
                    let produto;
                    produto = document.getElementById("buscaProdutos").value;

                    $.ajax({
                        url: "api/produtosusados/"+produto,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) { 
                            if(data.length !== 0 ){
                                
                                var tableHtml = "<table class='table'>";
                                tableHtml += "<tr><th>Codigo</th><th>Peça</th><th>Valor</th><th>Adicionar</th></tr>";
                                $.each(data, function(index, item) {
                                    tableHtml += "<tr>";
                                    tableHtml += "<td>" + item.codigo + "</td>";
                                    tableHtml += "<td>" + item.produto + "</td>";
                                    tableHtml += "<td>" + item.valor + "</td>";
                                    tableHtml += "<td><button type = 'button' class = 'btn btn-success' onclick = adicionaProduto("+item.codigo+")>+</td>";
                                    tableHtml += "</tr>";
                                });
                                tableHtml += "</table>";
                                $("#container-tabela").html(tableHtml);
                            }else{
                                $("#container-tabela").html("<p>Nenhum produto com o termo "+produto+" encontrado</p>" );
                            }
                        },
                    });
                }


                function adicionaProduto(codigoProduto){
                    let numLinhas;
                    let tabela;
                    $.ajax({
                        url: "api/adicionaProdutoID/"+codigoProduto,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) { 
                            $.each(data, function(index, item) {
                                numLinhas = $('#produtos-usados-tbody tr').length + 1;
                                tabela += "<tr id=linhaProdutos"+numLinhas+">";
                                tabela += " <td>"+item.produto+"</td>";
                                tabela += " <td>"+item.valor+"</td>";
                                tabela += " <td><button type='button' class='btn btn-danger' onclick='removerLinhaProduto("+numLinhas+")'>Remover</button></td>";
                                tabela += "</tr>";
                                $("#produtos-usados-tbody").append(tabela);
                            }) 
                        },
                    });
                }

                $(document).ready(function() {
                    $('#produtos-usados-table').on('DOMSubtreeModified', function() {
                        var valorFinal = 0
                        var valorProd = 0;
                        var valorServ = 0

                        var valorProdUsados = $('#produtos-usados-table tbody tr td:nth-child(2)').map(function() {
                            return $(this).text();
                        }).get();

                        var valorServPrestados = $('#servicos-prestados-table tbody tr td:nth-child(2)').map(function() {
                            return $(this).text();
                        }).get();

                        if(valorProdUsados.length > 0){
                            $.each(valorProdUsados, function(index, value) {
                                valorProd = valorProd + parseFloat(value);
                            });
                        }
                        
                        if(valorServPrestados.length > 0){
                            $.each(valorServPrestados, function(index, value) {
                                valorServ = valorServ + parseFloat(value);
                            });
                        }
                       
                        valorFinal = valorProd + valorServ;

                        $("#valorAtual").val(valorFinal);

                    });
                });

                function removerLinhaProduto(linha){
                    var linhaApagar = "#linhaProdutos"+linha;
                    $(linhaApagar).remove();
                }




                //funçoes dos serviços

                function servicosPrestados(){
                    let servicos;
                    servico = document.getElementById("buscaServicos").value;

                    $.ajax({
                        url: "api/servicosPrestados/"+servico,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) { 
                            if(data.length !== 0 ){
                                
                                var tableHtml = "<table class='table'>";
                                tableHtml += "<tr><th>Codigo</th><th>Serviço</th><th>Valor</th><th>Adicionar</th></tr>";
                                $.each(data, function(index, item) {
                                    tableHtml += "<tr>";
                                    tableHtml += "<td>" + item.codigo + "</td>";
                                    tableHtml += "<td>" + item.servico + "</td>";
                                    tableHtml += "<td>" + item.valor + "</td>";
                                    tableHtml += "<td><button type = 'button' class = 'btn btn-success' onclick = adicionaServico("+item.codigo+")>+</td>";
                                    tableHtml += "</tr>";
                                });
                                tableHtml += "</table>";
                                $("#container-tabela-servicos").html(tableHtml);
                            }else{
                                $("#container-tabela-servicos").html("<p>Nenhum produto com o termo "+servico+" encontrado</p>" );
                            }
                        },
                    });
                }

                function adicionaServico(codigoServico){
                    let numLinhas;
                    let tabela;
                    $.ajax({
                        url: "api/adicionaServicoID/"+codigoServico,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) { 
                            $.each(data, function(index, item) {
                                numLinhas = $('#produtos-usados-tbody tr').length + 1;
                                tabela += "<tr id=linhaProdutos"+numLinhas+">";
                                tabela += " <td>"+item.produto+"</td>";
                                tabela += " <td>"+item.valor+"</td>";
                                tabela += " <td><button type='button' class='btn btn-danger' onclick='removerLinhaProduto("+numLinhas+")'>Remover</button></td>";
                                tabela += "</tr>";
                                $("#produtos-usados-tbody").append(tabela);
                            }) 
                        },
                    });
                }
            </script>
    </div>
       
    @endif

@endsection