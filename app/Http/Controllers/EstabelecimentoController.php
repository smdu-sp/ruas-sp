<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstabelecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estabelecimentos = Estabelecimento::all()->toArray();
        return $estabelecimentos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->input('razao_social')){
            return response()->json(['success' => 0, 'message' => 'razao_social']);
        }

        $exists = DB::table('estabelecimentos')->where('cnpj', $request->input('cnpj'))->first();
        if($exists)
            return response()->json(['success' => 0, 'message' => 'cnpj_ja_cadastrado']);

        $estabelecimento = new Estabelecimento([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'celular' => $request->input('celular'),
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'complemento' => $request->input('complemento'),
            'cep' => $request->input('cep'),
            'coords_xy' => $request->input('coords_xy', false),
            'sql' => $request->input('sql'),
            'razao_social' => $request->input('razao_social'),
            'cnpj' => $request->input('cnpj'),
            'licenca_funcionamento' => $request->input('licenca_funcionamento'),
        ]);
        
        $estabelecimento->save();

        return response()->json(['success' => 1, 'message' => 'Salvo com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function show(Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Estabelecimento $estabelecimento)
    {
        $estabelecimento_db = Estabelecimento::find($estabelecimento->id);
        return response()->json($estabelecimento_db);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        return "Update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento)
    {
        return "Destroy";
    }
}
