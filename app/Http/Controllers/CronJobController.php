<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ClientRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CronJobController extends UtilController
{
    private $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;  
    }

    public function index(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/auth/me');
        $data = json_decode($response->getBody());

        $this->levelCheck($data->level);
        
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/cron-jobs',[
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

        return response()->view('cronJob.index', $structure);
    }

    public function create()
    {
        $data = $this->clientRepository->getAll();
        return response()->view('cronJob.create', [
            'clients' => $this->arrayToSelect($data->data, "id", "name")
        ]);
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/cron-jobs', [
            'client_id'   => $request->client_id,
            'description' => $request->description,
            'link'        => $request->link,
            'limit'       => !empty($request->limit) ? $request->limit : 0,
            'date'        => $request->date,
            'time'        => $request->time,
            'every_day'   => !empty($request->every_day ) ? 1 : 0,
            'every_time'  => !empty($request->every_time) ? 1 : 0,
            'status'      => 1
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return redirect()->route('cronJob.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function edit(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/cron-jobs/'.$request->id);
        $data = json_decode($response->getBody());

        $clients = $this->clientRepository->getAll();
        return response()->view('cronJob.edit', [
            'data'    => $data,
            'clients' => $this->arrayToSelect($clients->data, "id", "name")
        ]);
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/cron-jobs/'.$request->id, [
            'client_id'   => $request->client_id,
            'description' => $request->description,
            'link'        => $request->link,
            'limit'       => !empty($request->limit) ? $request->limit : 0,
            'date'        => $request->date,
            'time'        => $request->time,
            'every_day'   => !empty($request->every_day ) ? 1 : 0,
            'every_time'  => !empty($request->every_time) ? 1 : 0
        ]);

        if($response->successful())
        {
            return redirect()->route('cronJob.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/cron-jobs/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('cronJob.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
