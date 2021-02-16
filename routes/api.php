<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\EstabelecimentoController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('estabelecimentos', [EstabelecimentoController::class, 'index']);
Route::group(['prefix' => 'estabelecimento'], function() {
    Route::post('store', 'EstabelecimentoController@store');
});
