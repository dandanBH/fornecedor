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
        $user = Auth::id();
        $fornecedores = Fornecedor::where('id_usuario', $user)->orderBy('id', 'desc')->get();
        return view('fornecedor', compact('fornecedores'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        $fornecedor = new Fornecedor();
        $fornecedor->cnpj = preg_replace('/[^0-9]/', '', $request->cnpj);
        $response = Http::get('https://www.receitaws.com.br/v1/cnpj/' . $fornecedor->cnpj);
        $dados = $response->json();

        if (isset($dados['message'])){
            return redirect()->back()->with('erroMensagem', $dados['message']);
        }else if ($response->getStatusCode() != 200){
            return redirect()->back()->with('erroAPI', $response->getReasonPhrase());
        }else {
            $fornecedor->id_usuario = $user;
            $fornecedor->razao_social = $dados['nome'];
            $fornecedor->atividade_principal = $dados['atividade_principal'][0]['text'];
            $fornecedor->save();
            return redirect('/fornecedor')->with('success', 'Fornecedor Cadastrado com Sucesso');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Fornecedor $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Fornecedor $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Fornecedor $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Fornecedor $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
