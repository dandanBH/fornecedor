<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use Http;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$fornecedores = Fornecedor::latest()->paginate(10);
       // dd($fornecedor);
        $user = Auth::id();
        $fornecedores = Fornecedor::where('id_usuario',$user)->get();
        return view('fornecedor',compact('fornecedores'));
        //return view('listar',compact('pessoas'));
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
        //$user = Auth::user(); dados do usuario
        $user = Auth::id();

        $fornecedor = new Fornecedor();
        $fornecedor->cnpj = $request->cnpj;
        $response = Http::get('https://www.receitaws.com.br/v1/cnpj/'.$fornecedor->cnpj);
        $dados = $response->json();
        $fornecedor->id_usuario = $user;
        $fornecedor->razao_social = $dados['nome'];
        $fornecedor->atividade_principal = $dados['atividade_principal'][0]['text'];
        $fornecedor->save();

        return redirect('/fornecedor')->with('success', 'Cadastrado');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
