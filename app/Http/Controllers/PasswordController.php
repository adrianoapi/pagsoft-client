<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PasswordController extends Controller
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/password',[
            'page' => $page,
            'title' => $filter,
        ]);

        $data = json_decode($response->getBody());

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

        return response()->view('password.index', $structure);
    }

    public function show(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/password/'.$request->id);
        $data = json_decode($response->getBody());

        return response()->view('password.show', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/password/'.$request->id);
        $data = json_decode($response->getBody());

        return response()->view('password.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/password/'.$request->id, [
            'title' => $request->title,
            'login' => $request->login,
            'pass'  => $request->pass,
            'url'   => $request->url,
        ]);

        if($response->successful())
        {
            return redirect()->route('password.show', ['id' => $request->id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function create()
    {
        return response()->view('password.create');
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/password'.$request->id, [
            'title' => $request->title,
            'login' => $request->login,
            'pass'  => $request->pass,
            'url'   => $request->url,
        ]);

        if($response->successful())
        {
            return redirect()->route('password.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/password/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('password.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

}
