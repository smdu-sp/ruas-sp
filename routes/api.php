<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\EstabelecimentoController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cep/{cep}', function ($cep){
    $cep = env('MIX_CEP_API') . $cep . "/json/";
    return response()->json(json_decode(file_get_contents($cep)));
});

Route::get('/cnpj/{cnpj}', function ($cnpj){
    $cnpj = env('MIX_CNPJ_API') . $cnpj;
    return response()->json(json_decode(file_get_contents($cnpj)));
});

// Route::get('estabelecimentos', [EstabelecimentoController::class, 'index']);

Route::group(['prefix' => 'estabelecimento'], function() {
    Route::post('store', [EstabelecimentoController::class, 'store']);
});
