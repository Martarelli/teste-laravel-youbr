<?php

namespace App\Http\Controllers;

use index;
use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        //Captura dos campos do filtro
        $filtro = array(
            'nome' => isset($_GET['nome']) ? $_GET['nome'] : '' ,
            'email' => isset($_GET['email']) ? $_GET['email'] : '' ,
            'telefone' => isset($_GET['telefone']) ? $_GET['telefone'] : '' ,
            'cidade' => isset($_GET['cidade']) ? $_GET['cidade'] : '' ,
            'cargo' => isset($_GET['cargo']) ? $_GET['cargo'] : '' ,
        );

        //Inclusão dos filtros na Query
        $query = Cliente::query();

        if ($filtro['nome']){
            $query->where('nome','like', '%'. $filtro['nome'] .'%');
        }

        if($filtro['email'] !== ''){
            $query->where('email','like', '%'. $filtro['email'] .'%');
        }

        if($filtro['telefone'] !== ''){
            $query->where('telefone','like', '%'. $filtro['telefone'] .'%');
        }

        if($filtro['cidade'] !== ''){
            $query->where('cidade','like', '%'. $filtro['cidade'] .'%');
        }

        if($filtro['cargo'] !== ''){
            $query->where('cargo','like', '%'. $filtro['cargo'] .'%');
        }

        //Execução da consulta no BD
        $clientes = $query->orderBy('nome', 'asc')->get();

        return view('index', compact('clientes', 'filtro'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        //Validação dos campos do form
        $rules = [
            'nome' => 'required|max:255',
            'email' => 'required|max:255',
            'telefone' => 'required|max:255',
            'cidade' => 'required|max:255',
            'cargo' => 'required|max:255',
        ];

        $messages = [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'cidade.required' => 'O campo cidade é obrigatório.',
            'cargo.required' => 'O campo cargo é obrigatório.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        //Verificação se foi validado ou não
        if ($validator->fails()) {
            return response()->json(['message' => 'Falha na validação dos campos', 'error' => $validator->errors()], 422);
        }


        //Cria o registro no BD se email não existir
        if(Cliente::where('email', $request->email)) {

            return response()->json(['message' => 'Email já cadastrado', 422]);

        } else {
            $cliente = Cliente::create([
                'nome' => Str::lower($request->nome),
                'email' =>  Str::lower($request->email),
                'telefone' => $request->telefone,
                'cidade' => Str::lower($request->cidade),
                'cargo' => Str::lower($request->cargo),
            ]);

            return response()->json(['message' => 'Cliente criado com sucesso', 'cliente' => $cliente], 201);
        }
    }
}
