@extends('layouts/template')

@section('content')
<div class="w-100 d-flex flex-column justify-content-center p-5">
    <h1 class="text-center">Listagem dos Clientes</h1>
    {{-- Botão para criação de novo cliente --}}
    <a href="{{ url('/create') }}" class="btn btn-primary w-25 mb-4">Adicionar Cliente</a>
    {{-- Form para inclusão de filtro de pesquisa --}}
    <form class="d-flex justify-content-around align-items-center w-100" action="/" method="get">
        <div class="form-group">
            <label class="" for="nome">Nome</label>
            <input class="p-1" type="text" name="nome" value={{!empty($filtro) ? $filtro['nome'] : ''}}>
        </div>
        <div class="form-group">
            <label class="" for="email">E-mail</label>
            <input class="p-1" type="text" name="email" value={{!empty($filtro) ? $filtro['email'] : ''}}>
        </div>
        <div class="form-group">
            <label class="pl-3" for="telefone">Telefone</label>
            <input class="p-1" type="text" name="telefone" value={{!empty($filtro) ? $filtro['telefone'] : ''}}>
        </div>
        <div class="form-group">
            <label class="pl-3" for="cidade">Cidade</label>
            <input class="p-1" type="" name="cidade" value={{!empty($filtro) ? $filtro['cidade'] : ''}}>
        </div>
        <div class="form-group">
            <label class="pl-3" for="cargo">Cargo</label>
            <input class="p-1" type="" name="cargo" value={{!empty($filtro) ? $filtro['cargo'] : ''}}>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary px-3">Filtrar</button>
            <a href="/" class="btn btn-secondary">Limpar</a>
        </div>
    </form>
    {{-- Table para exibição dos dados de orçamentos cadastrados --}}
    <table class="table table-striped table-bordered table-hover table-light my-3">
        <thead>
            <tr>
                <th class="text-center" scope="col">Nome</th>
                <th class="text-center" scope="col">Email</th>
                <th class="text-center" scope="col">Telefone</th>
                <th class="text-center" scope="col">Cidade</th>
                <th class="text-center" scope="col">Cargo</th>
                <th class="text-center" scope="col">Data cadastro</th>
            </tr>
        </thead>
        <tbody>
        {{-- Exibição das linhas de registros encontrados --}}
        @foreach ($clientes as $cliente)
            <tr>
                <td class="text-center" style="width: 30%;">{{ucwords($cliente->nome)}}</td>
                <td class="text-center" style="width: 15%;">{{$cliente->email}}</td>
                <td class="text-center" style="width: 15%;">{{$cliente->telefone}}</td>
                <td class="text-center" style="width: 15%;">{{ucwords($cliente->cidade)}}</td>
                <td class="text-center" style="width: 15%;">{{ucwords($cliente->cargo)}}</td>
                <td class="text-center" style="width: 10%;">{{$cliente->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
