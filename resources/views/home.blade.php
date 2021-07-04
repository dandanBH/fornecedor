@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Cadastro de Fornecedor
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                    </div>
                </div>
                <br><br>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Lista de Fornecedores Cadastrados
                    </div>
                    <br class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="row">
                        <div class="card-body">
                            <table class="table table-borderless">
                            @foreach($fornecedores as $fornecedor)
                                    <tr>

                                        <td colspan="2">{{$fornecedor->razao_social}}</td>
                                    </tr>
                                    <tr>
                                        <th>CNPJ:</th>
                                        <td>{{$fornecedor->cnpj}}</td>
                                    </tr>
                                    <tr>
                                        <th>Atividade Principal:</th>
                                        <td>{{$fornecedor->atividade_principal}}</td>
                                    </tr>
                                    <tr>
                                        <th>Cadastro em:</th>
                                        <td>{{$fornecedor->created_at->format('d/m/Y H:i:s')}}</td>
                                    </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
