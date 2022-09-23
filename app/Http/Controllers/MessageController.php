<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends UtilController
{

    public function class()
    {
        return response()->view('diagram.class');
    }

    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/message',[
            'page' => $page,
            'description' => $filter,
            'status' => 1,
            'limit'  => 20,
        ]);

        
        $data = json_decode($response->getBody());

        dd($data);

        $structure = [
            'data' => $data->data,
            'first_page_url' => $data->first_page_url,
            'last_page_url' => $data->last_page_url,
            'next_page_url' => $data->next_page_url,
            'last_page' => $data->last_page,
            'from' => intval($page) - 1,
            'to' => intval($page) + 1,
            'now' => intval($page),
            'filter' => $filter,
        ];

        return response()->view('client.index', $structure);
    }

    public function create()
    {
        return response()->view('client.create');
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/clients', [
            'name' => $request->name,
            'responsavel'  => $request->responsavel,
            'cpf_cnpj'  => $request->cpf_cnpj,
            'ie'  => $request->ie,
            'telefone'  => $request->telefone,
            'telefone_com'  => $request->telefone_com,
            'celular'  => $request->celular,
            'email'  => $request->email,
            'cep'  => $request->cep,
            'endereco'  => $request->endereco,
            'numero'  => $request->numero,
            'complemento'  => $request->complemento,
            'bairro'  => $request->bairro,
            'cidade'  => $request->cidade,
            'estado'  => $request->estado,
            'status'  => 1
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return redirect()->route('client.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function edit(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/clients/'.$request->id);
        $data = json_decode($response->getBody());


        return response()->view('client.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/clients/'.$request->id, [
            'name' => $request->name,
            'responsavel'  => $request->responsavel,
            'cpf_cnpj'  => $request->cpf_cnpj,
            'ie'  => $request->ie,
            'telefone'  => $request->telefone,
            'telefone_com'  => $request->telefone_com,
            'celular'  => $request->celular,
            'email'  => $request->email,
            'cep'  => $request->cep,
            'endereco'  => $request->endereco,
            'numero'  => $request->numero,
            'complemento'  => $request->complemento,
            'bairro'  => $request->bairro,
            'cidade'  => $request->cidade,
            'estado'  => $request->estado
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return redirect()->route('client.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/clients/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('client.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
