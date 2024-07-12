<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\NovaOSController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ServicosController;





// Route::get('/cliente/{cpf}', [ClientesController::class, 'Clientepelocpf']);

// Route::get('/produtosusados/{produto}', [ProdutosController::class, 'produtosUsados']);
// Route::get('/adicionaProdutoID/{codigo}', [ProdutosController::class, 'adicionaProdutoID']);


// Route::get('/servicosPrestados/{codigo}', [ProdutosController::class, 'servicosUsados']);


Route::get('/novaOS', function () {
    return view('novaOS');

    
});

Route::get('/', function () {
    return view('home');

    
});

Route::get('/consultar', function () {
    return view('consultar');

    
});


Route::get('/consultar/{id}', [NovaOSController::class, 'Consulta']);


Route::get('/listarOS', function () {
    return view('verificarOrdem');
});

Route::post('/novaOS/cadastrar', [NovaOSController::class, 'Post']);

Route::post('/buscar-OS', [NovaOSController::class, 'Consulta']);

Route::post('/buscar-OS-tipo', [NovaOSController::class, 'Consulta_Tipo']);

Route::put('/Salvar-os/{id}', [NovaOSController::class, 'Editar']);


Route::get('/consultarCliente/{texto}', [ClientesController::class, 'clientepelocpf']);
Route::post('/consultarCliente/{texto}', [ClientesController::class, 'dadoscompletos']);