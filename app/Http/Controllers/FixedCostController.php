<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FixedCostController extends UtilController
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/fixedCost',[
            'page' => $page,
            'description' => $filter,
            'status' => 1,
            'limit'  => 20,
        ]);

        $data = json_decode($response->getBody());

        $structure = [
            'ledger_group'    => $this->ledgerGroupToArray(session('ledger_group')),
            'transition_type' => $this->transitionTypeToArray(session('transition_type')),
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

        return response()->view('fixedCost.index', $structure);
    }

    public function trash(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/fixedCost',[
            'page' => $page,
            'description' => $filter,
            'status' => 0,
            'limit'  => 20,
        ]);

        $data = json_decode($response->getBody());

        $structure = [
            'ledger_group'    => $this->ledgerGroupToArray(session('ledger_group')),
            'transition_type' => $this->transitionTypeToArray(session('transition_type')),
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

        return response()->view('fixedCost.trash', $structure);
    }

    /*$response->body() : string;
    $response->json() : array|mixed;
    $response->object() : object;
    $response->collect() : Illuminate\Support\Collection;
    $response->status() : int;
    $response->ok() : bool;
    $response->successful() : bool;
    $response->failed() : bool;
    $response->serverError() : bool;
    $response->clientError() : bool;
    $response->header($header) : string;
    $response->headers() : array;*/
    public function send(Request $request)
    {
        $rst = $this->getById($request->id);
        if(!empty($rst))
        {
            $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/ledgerEntries', [
                'description'        => $rst->description,
                'ledger_group_id'    => $rst->ledger_group_id,
                'transition_type_id' => $rst->transition_type_id,
                'amount'             => $rst->amount,
                'installments'       => 0,
                'entry_date'         => date('Y-m-d'),
            ]);

            if($response->successful())
            {
                return redirect()->route('ledgerEntry.index');
            }else{
                dd($response->getBody()->getContents());
            }
        }
    }

    public function getById(int $id)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/fixedCost/'.$id);
        $data = json_decode($response->getBody());

        return $data;
    }

    public function sendTrash(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/fixedCost/'.$request->id.'/trash', []);

        if($response->successful())
        {
            return redirect()->route('fixedCost.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function restore(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/fixedCost/'.$request->id.'/restore', []);

        if($response->successful())
        {
            return redirect()->route('fixedCost.trash');
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
