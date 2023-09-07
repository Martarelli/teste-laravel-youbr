@extends('layouts/template')

@section('content')
<div class="w-100 d-flex flex-column justify-content-center align-items-center ">
    <h1 class="mt-5">Adicionar Cliente</h1>
    {{-- Form de inclusão dos dados do cliente --}}
    <form id="create-cliente-form" class="w-50">
        @csrf
        <div class="form-group">
            <label class="mt-3" for="nome">Nome</label>
            <input class="w-100 p-2" type="text" name="nome">
        </div>
        <div class="form-group">
            <label class="mt-3" for="email">E-mail</label>
            <input class="w-100 p-2" type="text" name="email">
        </div>
        <div class="form-group">
            <label class="mt-3" for="telefone">Telefone</label>
            <input class="w-100 p-2" type="text" name="telefone">
        </div>
        <div class="form-group">
            <label class="mt-3" for="cidade">Cidade</label>
            <input class="w-100 p-2" type="text" name="cidade">
        </div>
        <div class="form-group">
            <label class="mt-3" for="cargo">Cargo</label>
            <input class="w-100 p-2" type="text" name="cargo">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">Salvar Cliente</button>
        <button type="reset" class="btn btn-secondary w-100 mt-4">Limpar</button>
        <a href="{{ url('/') }}" class="btn btn-light w-100 mt-4">Voltar</a>
    </form>

    <script >
        $(document).ready(function() {
            $('#create-cliente-form').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '/create/store',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(error) {

                        alert(error.responseJSON.message);

                        for(erro in error.responseJSON.error){
                            alert(error.responseJSON.error[erro][0]);
                        }
                    }
                });
            });
        });
    </script>
</div>
@endsection
