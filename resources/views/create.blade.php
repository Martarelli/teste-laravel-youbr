@extends('layouts/template')

@section('content')
{{-- Exibição do erro de validação --}}
@if($errors->any())
    <div class="alert alert-danger m-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="w-100 d-flex flex-column justify-content-center align-items-center ">
    <h1 class="mt-3">Adicionar Cliente</h1>
    {{-- Form de inclusão dos dados do cliente --}}
    <form class="w-50" method="post">
        @csrf
        <div class="form-group">
            <label class="mt-3" for="email">E-mail</label>
            <input class="w-100" type="text" name="email">
        </div>
        <div class="form-group">
            <label class="mt-3" for="nome">Nome</label>
            <input class="w-100" type="text" name="nome">
        </div>
        <div class="form-group">
            <label class="mt-3" for="telefone">Telefone</label>
            <input class="w-100" type="text" name="telefone">
        </div>
        <div class="form-group">
            <label class="mt-3" for="cidade">Cidade</label>
            <input class="w-100" type="text" name="cidade">
        </div>
        <div class="form-group">
            <label class="mt-3" for="cargo">Cargo</label>
            <input class="w-100" type="text" name="cargo">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">Salvar Orçamento</button>
        <button type="reset" class="btn btn-secondary w-100 mt-4">Limpar</button>
        <a href="{{ url('/') }}" class="btn btn-light w-100 mt-4">Voltar</a>
    </form>

</div>
@endsection
