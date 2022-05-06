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
       //
    }

    public function checkAuth()
    {
        if(!session()->get('access_token'))
       {
           die('Not access_token!');
       }
    }

    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
            $filter = !empty($request->filter) ? $request->filter : null;
            $page = !empty($request->page) ? $request->page : 1;
            $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/event',[
                'page' => $page,
                'title' => $filter,
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
            'all_day'  => !empty($request->all_day) ? 1 : 0
        ]);

        if($response->successful())
        {
            /** Melhorar esse codigo */
            $filter = !empty($request->filter) ? $request->filter : null;
            $page = !empty($request->page) ? $request->page : 1;
            $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/event',[
                'page' => $page,
                'title' => $filter,
            ]);
    
            $data = json_decode($response->getBody());
             /** Melhorar esse codigo */

            return response()->json(end($data->data));
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function eidt(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/collections/'.$request->id);
        $data = json_decode($response->getBody());

        return response()->view('collection.edit', [
            'data' => $data,
            'orderList' => $this->showOrder(),
            'layoutList' => $this->showLayout()
        ]);
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/collections/'.$request->id, [
            'title'            => $request->title,
            'description'      => $request->description,
            'show_id'          => !empty($request->show_id         ) ? 1 : 0,
            'show_image'       => !empty($request->show_image      ) ? 1 : 0,
            'show_title'       => !empty($request->show_title      ) ? 1 : 0,
            'show_description' => !empty($request->show_description) ? 1 : 0,
            'show_release'     => !empty($request->show_release    ) ? 1 : 0,
            'order'            => $request->order,
            'layout'           => $request->layout,
        ]);

        if($response->successful())
        {
            return redirect()->route('collection.show', ['id' => $request->id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/collections/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('collection.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
