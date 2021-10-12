<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return response()->view('login.index');
    }

    public function auth(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
            'email' => $request->username,
            'password' => $request->password,
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
