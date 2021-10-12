<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    private $access_token;

    public function auth()
    {
        if(empty(session()->get('access_token')))
        {
            $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
                'email' => '',
                'password' => '',
            ]);

            if(!empty($response))
            {
                $data = json_decode($response);
                if(array_key_exists('access_token', $data))
                {
                    session(['access_token' => $data->access_token]);
                }
            }
        }
    }

    public function index()
    {
        echo 'oi index';
    }

    public function getCollection(Request $request)
    {
        $page = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get('http://127.0.0.1:8000/api/collections',[
            'page' => $page,
            #'title' => 'revista',
        ]);
        $data = json_decode($response->getBody());

        /*echo '<pre>';
        var_dump($data);
        die();*/

        $structure = [
            'data' => $data->data,
            'first_page_url' => $data->first_page_url,
            'last_page_url' => $data->last_page_url,
            'next_page_url' => $data->next_page_url,
            'last_page' => $data->last_page,
            'from' => intval($request->page) - 1,
            'to' => intval($request->page) + 1,
            'now' => intval($request->page),
        ];

        return response()->view('client.index', $structure);
    }
}
