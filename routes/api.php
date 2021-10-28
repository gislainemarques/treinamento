<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/treinamento', function(Request $request) {
    dd ($request->headers->get('Authorization'));

    $response = new \Illuminate\Http\Response(json_encode(['msg' => 'Resposta de API']));
    $response->header('Content-Type','application/json');

    return $response;

});

Route::prefix('pessoas')->group(function() {
    Route::get('/', 'App\Http\Controllers\Api\PessoaController@index');
    Route::get('/{id}', 'App\Http\Controllers\Api\PessoaController@show');
    Route::get('/{id}/carros', 'App\Http\Controllers\Api\PessoaController@carro');
    Route::post('/', 'App\Http\Controllers\Api\PessoaController@save');
    Route::put('/', 'App\Http\Controllers\Api\PessoaController@update');
    Route::patch('/', 'App\Http\Controllers\Api\PessoaController@update');
    Route::delete('/{id}', 'App\Http\Controllers\Api\PessoaController@delete');

    Route::post('/{id}/carros', 'App\Http\Controllers\Api\PessoaController@saveCarro');
    Route::delete('/{id}/carros/{placa}', 'App\Http\Controllers\Api\PessoaController@deleteCarro');
});

Route::prefix('carros')->group(function() {
    Route::get('/', 'App\Http\Controllers\Api\CarroController@index');
    Route::get('/{placa}', 'App\Http\Controllers\Api\CarroController@showCarroComPessoa');
    Route::post('/', 'App\Http\Controllers\Api\CarroController@save');
    Route::delete('/{id}', 'App\Http\Controllers\Api\CarroController@delete');
});

//Route::resource('/pessoas','App\Http\Controllers\Api\PessoaController');
