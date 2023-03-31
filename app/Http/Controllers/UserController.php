<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends UtilController
{
    public function index(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        $this->levelCheck($data->level);
        
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/users',[
            'page' => $page,
            'description' => $filter,
            'status' => 1,
            'limit'  => 20,
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

        return response()->view('user.index', $structure);
    }

    public function profile()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        return response()->view('user.profile', ['user' => $data]);
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
