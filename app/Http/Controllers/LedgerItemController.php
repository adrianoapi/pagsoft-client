<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LedgerItemController extends Controller
{
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
