<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
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
//retorna todasas cidades cadastradas na base de dados
Route::get('cities', [apiController::class, 'index']);

//retorna uma cidade só  cidades cadastradas na base de dados
Route::get('cities/{id}', [apiController::class, 'show']);

//faz um cadastro nas cidades
Route::post('cities', [apiController::class, 'store']);

//altera um cadastro nas cidades
Route::put('cities/{id}', [apiController::class, 'update']);

//delete o registro cidades cadastradas na base de dados
Route::delete('cities/{id}', [apiController::class, 'destroy']);

//TODO busca uma cidade na api e grava no banco

//TODO busca uma lista de cidades e grava 

//TODO busca todos dados de uma cidade no banco 

 