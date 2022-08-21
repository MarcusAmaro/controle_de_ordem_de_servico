<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\NovaOSController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

    
});


Route::get('/novaOS', function () {
    return view('novaOS');

    
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


