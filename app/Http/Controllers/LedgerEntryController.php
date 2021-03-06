<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LedgerEntryController extends UtilController
{
    public function index(Request $request)
    {
        $filter  = !empty($request->filter ) ? $request->filter  : null;
        $page    = !empty($request->page   ) ? $request->page    : 1;
        $beginDt = !empty($request->beginDt) ? $request->beginDt : null;
        $endDt   = !empty($request->endDt  ) ? $request->endDt   : null;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries',[
            'page' => $page,
            'description' => $filter,
            'limit' => 20,
        ]);

        $data = json_decode($response->getBody());

        $structure = [
            'ledger_group'    => $this->ledgerGroupToArray(session('ledger_group')),
            'transition_type' => $this->transitionTypeToArray(session('transition_type')),
            'data' => $data->data,
            'first_page_url' => $data->first_page_url,
            'last_page_url'  => $data->last_page_url,
            'next_page_url'  => $data->next_page_url,
            'last_page'      => $data->last_page,
            'from'    => intval($page) - 1,
            'to'      => intval($page) + 1,
            'now'     => intval($page),
            'filter'  => $filter,
            'beginDt' => $beginDt,
            'endDt'   => $endDt,
        ];

        return response()->view('ledgerEntry.index', $structure);
    }

    public function getById(int $id)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries/collection/'.$id);
        $data = json_decode($response->getBody());

        return $data;
    }

    public function show(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries/collection/'.$request->id);
        $data = json_decode($response->getBody());

        $structure = [
            'collection' => $data->collection,
            'data' => $data->ledgerItems,
            'from' => intval($request->page) - 1,
            'to'   => intval($request->page) + 1,
            'now'  => intval($request->page),
        ];

        return response()->view('ledgerEntry.show', $structure);
    }

    public function create()
    {
        $structure = [
            'ledger_group'    => $this->arrayToSelect(session('ledger_group')),
            'transition_type' => $this->arrayToSelect(session('transition_type')),
        ];

        return response()->view('ledgerEntry.create', ['data' => $structure]);
    }

    public function edit(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries/'.$request->id);
        $data = json_decode($response->getBody());

        $structure = [
            'ledger_group'    => $this->arrayToSelect(session('ledger_group')),
            'transition_type' => $this->arrayToSelect(session('transition_type')),
            'data' => $data,
        ];

        return response()->view('ledgerEntry.edit', ['structure' => $structure]);
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/ledgerEntries', [
            'description'        => $request->description,
            'ledger_group_id'    => $request->ledger_group_id,
            'transition_type_id' => $request->transition_type_id,
            'amount'             => $request->amount,
            'entry_date'         => $request->entry_date,
            'installments'       => $request->installments,
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return redirect()->route('ledgerEntry.show', ['id' => $data->id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->put(getenv('API_URL').'api/ledgerEntries/'.$request->id, [
            'description'        => $request->description,
            'ledger_group_id'    => $request->ledger_group_id,
            'transition_type_id' => $request->transition_type_id,
            'amount'             => $request->amount,
            'entry_date'         => $request->entry_date,
            'installments'       => $request->installments,
        ]);

        if($response->successful())
        {
            return redirect()->route('ledgerEntry.show', ['id' => $request->id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/ledgerEntries/'.$request->id, [
            'ledger_entry_id' => $request->id
        ]);

        if($response->successful())
        {
            return redirect()->route('ledgerEntry.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function clone(Request $request)
    {
        $rst = $this->getById($request->id);

        if(!empty($rst))
        {
            $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/ledgerEntries', [
                'description'        => $rst->collection->description,
                'ledger_group_id'    => $rst->collection->ledger_group_id,
                'transition_type_id' => $rst->collection->transition_type_id,
                'amount'             => $rst->collection->amount,
                'entry_date'         => date('Y-m-d'),
                'installments'       => $rst->collection->installments,
            ]);

            if($response->successful())
            {
                $data = json_decode($response->getBody());
                return redirect()->route('ledgerEntry.show', ['id' => $data->id]);
            }else{
                dd($response->getBody()->getContents());
            }
        }
    }

    public function flow(Request $request)
    {
        $data    = NULL;
        $id      = !empty($request->ledger_group_id ) ? $request->ledger_group_id  : null;
        $dtBegin = !empty($request->entry_date_begin) ? $request->entry_date_begin : date('Y-m-01');
        $dtEnd   = !empty($request->entry_date_end  ) ? $request->entry_date_end   : date('Y-m-t');

        if(!empty($request->all()))
        {
            $data = $this->getFlow($request);
        }

        $structure = [
            'ledger_group'    => $this->arrayToSelect(session('ledger_group')),
            'transition_type' => $this->arrayToSelect(session('transition_type')),
            'data' => $data,
            'ledger_group_id' => $id,
            'entry_date_begin' => $dtBegin,
            'entry_date_end' => $dtEnd,
        ];
        return response()->view('ledgerEntry.flow', $structure);
    }

    private function getFlow(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerEntries/flow',[
            'ledger_group_id'  => $request->ledger_group_id,
            'entry_date_begin' => $request->entry_date_begin,
            'entry_date_end'   => $request->entry_date_end,
        ]);

        if(!$response->successful())
        {
            dd($response->getBody()->getContents());
        }

        return json_decode($response->getBody());
    }

}
