<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionItemController extends Controller
{
    public function edit(Request $request)
    {
        die($request->id);
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/ledgerItems/'.$request->id);
        $data = json_decode($response->getBody());

        dd($data);

        #return view('addCollectionItem', ['collection' => $collection, 'collItem' => $collectionItem]);
    }

    public function update()
    {
        //
    }
}
