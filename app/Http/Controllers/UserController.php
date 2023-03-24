<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends UtilController
{
    public function index()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        return response()->view('user.index', ['user' => $data]);
    }

    public function create()
    {
        $a = rand(1,9);
        $b = rand(1,5);
        $c = rand(2,5);
        $d = rand(1,3);

        session()->put('captcha', $a+$b-$c);

        return response()->view('user.create', ['captcha' => "{$a}+{$b}-{$c}=?"]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:5',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'captcha'  => 'required'
        ]);

        if($request->password != $request->password_check)
        {
            return \redirect()->back()->withInput()->withErrors(['As senhas estão coincidem!']);
        }

        if(session()->get('captcha') != $request->captcha)
        {
            return \redirect()->back()->withInput()->withErrors(['O captcha está incorreto!']);
        }

        $model = new User();
        $model->name      = $request->name;
        $model->email     = $request->email;
        $model->password  = Hash::make($request->password);
        $model->active    = true;
        $model->save();

        return redirect()->route('login')->with(
            'user_create',
            'Usuário <strong>'.$request->name.'</strong> criado com sucesso!'
        );
    }
}
