<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class EventController extends UtilController
{
    private $access_token;

    public function __construct()
    {
        
    }

    public function checkAuth()
    {
        if(!session()->get('access_token'))
       {
           die('Not access_token!');
       }
    }

    public function show(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/event/'.$request->id);

        echo $response->getBody();
    }

    public function index(Request $request)
    {

        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        $this->levelCheck($data->level);
  
        if($request->ajax()) {
       
            $filter = !empty($request->filter) ? $request->filter : null;
            $page = !empty($request->page) ? $request->page : 1;
            $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/event',[
                'page'  => $page,
                'title' => $filter,
                'start' => $request->start,
                'end'   => $request->end,
            ]);
    
            $data = json_decode($response->getBody());

            return response()->json($data->data);
        }
  
        return view('event.index');
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/event', [
            'title'    => $request->title,
            'start'    => $request->start,
            'end'      => $request->end,
            'location' => $request->location,
            'editable' => true,
            'all_day'  => !empty($request->all_day) ? 1 : 0,
            'backgroundColor' => NULL
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return response()->json($data->body);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/event/'.$request->id, [
            'title'    => $request->title,
            'start'    => $request->start,
            'end'      => $request->end,
            'location' => $request->location,
            'editable' => true,
            'all_day'  => !empty($request->all_day) ? 1 : 0,
            'backgroundColor' => !empty($request->backgroundColor) ? $request->backgroundColor : NULL
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return response()->json($data->body);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/event/'.$request->id, []);

        if($response->successful())
        {
            return 1;
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
