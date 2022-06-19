<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagramController extends UtilController
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/diagram',[
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

        return response()->view('diagram.index', $structure);

    }
}
