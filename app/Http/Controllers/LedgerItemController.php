<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LedgerItemController extends UtilController
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page  ) ? $request->page : 1;

        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerItems',[
            'page' => $page,
            'description' => $filter,
            'limit' => 50,
        ]);
        $data = json_decode($response->getBody());

        if($request->ajax())
        {
            $response = [];
            foreach($data->data as $value):
                $response[] = array("value"=>$value->id,"label"=>$value->description);
            endforeach;

            return json_encode($response);
        }

        $structure = [
            'ledger_group'    => $this->ledgerGroupToArray(session('ledger_group')),
            'transition_type' => $this->transitionTypeToArray(session('transition_type')),
            'data' => $data->data,
            'first_page_url' => $data->first_page_url,
            'last_page_url'  => $data->last_page_url,
            'next_page_url'  => $data->next_page_url,
            'last_page'      => $data->last_page,
            'from'   => intval($page) - 1,
            'to'     => intval($page) + 1,
            'now'    => intval($page),
            'filter' => $filter,
        ];

        return response()->view('ledgerItem.index', $structure);
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/ledgerItems', [
            'ledger_entry_id' => $request->ledger_entry_id,
            'description'     => $request->description,
            'quantity'        => $request->quantity,
            'price'           => $request->price,
            'total_price'     => $request->total_price,
        ]);

        if($response->successful())
        {
            return redirect()->route('ledgerEntry.show', ['id' => $request->ledger_entry_id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function destroy(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/ledgerItems/'.$request->id, [
            'ledger_entry_id' => $request->ledger_entry_id
        ]);

        if($response->successful())
        {
            return redirect()->route('ledgerEntry.show', ['id' => $request->ledger_entry_id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
