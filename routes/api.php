<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cliente/{cpf}', [ClientesController::class, 'Clientepelocpf']);

Route::get('/produtosusados/{produto}', [ProdutosController::class, 'produtosUsados']);
Route::get('/adicionaProdutoID/{codigo}', [ProdutosController::class, 'adicionaProdutoID']);


Route::get('/servicosPrestados/{codigo}', [ServicosController::class, 'servicosUsados']);