<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LedgerEntryController extends Controller
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries',[
            'page' => $page,
            'description' => $filter,
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

        return response()->view('ledgerEntry.index', $structure);
    }

    public function show(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries/collection/'.$request->id);
        $data = json_decode($response->getBody());

        $structure = [
            'collection' => $data->collection,
            'data' => $data->ledgerItems,
            'from' => intval($request->page) - 1,
            'to' => intval($request->page) + 1,
            'now' => intval($request->page),
        ];

        return response()->view('ledgerEntry.show', $structure);
    }

    public function ledgerGroupToArray(array $data)
    {
        $arr = [];
        foreach($data as $value):
            $arr[$value->id] = [
                'ledger_group_id' => $value->ledger_group_id,
                'title' => $value->title,
            ];
        endforeach;

        return $arr;
    }

    public function transitionTypeToArray(array $data)
    {
        $arr = [];
        foreach($data as $value):
            $arr[$value->id] = [
                'title' => $value->title,
                'description' => $value->description,
                'action' => $value->action,
            ];
        endforeach;

        return $arr;
    }

}
