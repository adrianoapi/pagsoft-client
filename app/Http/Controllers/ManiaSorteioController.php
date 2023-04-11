<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Hash;

class ManiaSorteioController extends UtilController
{
    public function index(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        $this->levelCheck($data->level);
        
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/mania/jogos',[
            'page' => $page,
            'description' => $filter,
            'status' => 1,
            'limit'  => 20,
        ]);
        
        $data = json_decode($response->getBody());

        $structure = [
            'data' => $data,
        ];

        return response()->view('mania.jogo', $structure);
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/mania/sorteios/'.$request->id, [
            'id' => $request->id
        ]);

        if($response->successful())
        {
            return redirect()->route('mania.jogos');
        }else{
            dd($response->getBody()->getContents());
        }
    }

}
