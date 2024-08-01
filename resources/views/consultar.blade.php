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
                                    <th>Codigo</th>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Ação</th>
                                <tr>
                            <thead>
                            <tbody id='produtos-usados-tbody'>
                                
                                @if(!empty($dadosServicos))
                                    @foreach($dadosProdutos as $linhas)
                                        <tr>
                                        <td>{{ $linhas[0] }}</td>
                                        <td>{{ $linhas[1] }}</td>
                                        <td>{{ $linhas[2] }}</td>
                                        <td><button class="btn btn-danger btn-remove-prod" onclick="atualizaProdutosRemovidosInput({{ $linhas[0] }})">Remover</button></td>
                                        </tr>
                                    @endforeach
                                @endif
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
                                <th>Codigo</th>
                                <th>Serviços</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </thead>
                            <tbody id='servicos-prestados-tbody'>
                                @if(!empty($dadosServicos))
                                    @foreach($dadosServicos as $linhas)
                                        <tr>
                                        <td>{{ $linhas[0] }}</td>
                                        <td>{{ $linhas[1] }}</td>
                                        <td>{{ $linhas[2] }}</td>
                                        <td><button class="btn btn-danger btn-remove-serv" onclick="atualizaServicosRemovidosInput({{ $linhas[0] }})">Remover</button></td>
                                        
                                        </tr>
                                    @endforeach
                                @endif

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
                    <input type="hidden" name="valorAtualCampo" id="valorAtualCampo">
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

        <input type="hidden" name="produtosUsadosOrdem"             id="produtosUsadosOrdem">
        <input type="hidden" name="servicosPrestadosOrdem"          id="servicosPrestadosOrdem">

        <input type="hidden" name="produtosRemovidosUsadosOrdem"    id="produtosRemovidosUsadosOrdem">
        <input type="hidden" name="servicosRemovidosPrestadosOrdem" id="servicosRemovidosPrestadosOrdem">

        <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-primary gravar-ordem">Salvar nova OS</button>
        </div>

        </form>

        @endforeach
            <script>
                $(document).ready(function() {
                    var total = 0;
                    $('#produtos-usados-tbody tr').each(function() {
                        var valor = parseFloat($(this).find('td:nth-child(3)').text());
                        if (!isNaN(valor)) {
                            total += valor;
                        }
                    });

                    $('#servicos-prestados-tbody tr').each(function() {
                        var valor = parseFloat($(this).find('td:nth-child(3)').text());
                        if (!isNaN(valor)) {
                            total += valor;
                        }
                    });


                    $('#valorAtual').val(total.toFixed(2)); // Define o valor total no input, formatado com duas casas decimais

                });

                $('#servicos-prestados-tbody').on('click', '.btn-remove-serv', function() {
                    $(this).closest('tr').remove();
                });

                $('#produtos-usados-tbody').on('click', '.btn-remove-prod', function() {
                    $(this).closest('tr').remove();
                });


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
                                tabela += " <td>"+codigoProduto+"</td>";
                                tabela += " <td>"+item.produto+"</td>";
                                tabela += " <td>"+item.valor+"</td>";
                                tabela += " <td><button type='button' class='btn btn-danger' onclick='removerLinhaProduto("+numLinhas+")'>Remover</button></td>";
                                tabela += "</tr>";
                                $("#produtos-usados-tbody").append(tabela);
                            }) 
                        },

                    });
                    atualizarProdutosUsadosInput();
                }

                $(document).ready(function() {
                    $('#produtos-usados-table').on('DOMSubtreeModified', function() {
                        var valorFinal = 0
                        var valorProd = 0;
                        var valorServ = 0
                        var valorProdUsados = $('#produtos-usados-table tbody tr td:nth-child(3)').map(function() {
                            return $(this).text();
                        }).get();
                        var valorServPrestados = $('#servicos-prestados-table tbody tr td:nth-child(3)').map(function() {
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
                        $("#valorAtualCampo").val(valorFinal);
                        
                    });
                });

                $(document).ready(function() {
                    $('#servicos-prestados-table').on('DOMSubtreeModified', function() {
                        var valorFinal = 0
                        var valorProd = 0;
                        var valorServ = 0
                        var valorProdUsados = $('#produtos-usados-table tbody tr td:nth-child(3)').map(function() {
                            return $(this).text();
                        }).get();

                        var valorServPrestados = $('#servicos-prestados-table tbody tr td:nth-child(3)').map(function() {
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
                        $("#valorAtualCampo").val(valorFinal);


                    });
                });

                function removerLinhaProduto(linha){
                    var linhaApagar = "#linhaProdutos"+linha;
                    $(linhaApagar).remove();
                    atualizarProdutosUsadosInput()
                }

                 function removerLinhaServico(linha){
                    var linhaApagar = "#linhaServico"+linha;
                    $(linhaApagar).remove();
                    atualizarServicosPrestadosInput()
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
                                numLinhas = $('#servicos-prestados-tbody tr').length + 1;
                                tabela += "<tr id=linhaServico"+numLinhas+">";
                                tabela += " <td>"+codigoServico+"</td>";
                                tabela += " <td>"+item.servico+"</td>";
                                tabela += " <td>"+item.valor+"</td>";
                                tabela += " <td><button type='button' class='btn btn-danger' onclick='removerLinhaServico("+numLinhas+")'>Remover</button></td>";
                                tabela += "</tr>";
                                $("#servicos-prestados-tbody").append(tabela);
                            }) 
                        },
                    });
                    atualizarServicosPrestadosInput()
                }

                function atualizaProdutosRemovidosInput($codigo){
                    var removidos = $('#produtosRemovidosUsadosOrdem').val();
                    if (removidos) {
                        removidos = JSON.parse(removidos);
                    } else {
                        removidos = [];
                    }
                    removidos.push({codigo: $codigo});
                    $('#produtosRemovidosUsadosOrdem').val(JSON.stringify(removidos));
                   
                    
                }
                

                function atualizaServicosRemovidosInput($codigo){
                    var removidos = $('#servicosRemovidosPrestadosOrdem').val();
                    if (removidos) {
                        removidos = JSON.parse(removidos);
                    } else {
                        removidos = [];
                    }
                    removidos.push({codigo: $codigo});
                    $('#servicosRemovidosPrestadosOrdem').val(JSON.stringify(removidos));
                   
                    
                }

                function atualizarProdutosUsadosInput() {
                    var produtos = [];   
                    setTimeout(function() {
                        $('#produtos-usados-table tbody tr').each(function() {
                            var codigo = $(this).find('td').eq(0).text();
                            var produto = $(this).find('td').eq(1).text();
                            var valor = $(this).find('td').eq(2).text();
                            produtos.push({ codigo: codigo ,produto: produto, valor: valor });
                         });

                         $('#produtosUsadosOrdem').val(JSON.stringify(produtos));
                    }, 1000);
                }   

                function atualizarServicosPrestadosInput() {
                    var servicos = [];
                     setTimeout(function() {           
                       $('#servicos-prestados-table tbody tr').each(function() {
                            var codigo = $(this).find('td').eq(0).text();
                            var servico = $(this).find('td').eq(1).text();
                            var valor = $(this).find('td').eq(2).text();
                            servicos.push({ codigo: codigo, servico: servico, valor: valor });
                        });
                        $('#servicosPrestadosOrdem').val(JSON.stringify(servicos));
                        console.log(servicos)
                    }, 1000);             
                }
            </script>
    </div>  
    @endif
@endsection