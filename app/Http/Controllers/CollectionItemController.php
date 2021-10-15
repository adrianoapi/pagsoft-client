<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CollectionItemController extends Controller
{
    private $url;

    public function __construct()
    {
        $this->url = getenv('API_URL').'api/collectionItem/';
    }

    public function tocken()
    {
        return session()->get('access_token');
    }

    public function edit(Request $request)
    {
        $response = Http::withToken($this->tocken())->get(getenv('API_URL').'api/collectionItem/'.$request->id);
        $data = json_decode($response->getBody());

        return response()->view('collection.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $response = Http::withToken($this->tocken())->put($this->url.$request->id, [
            'title'       => $request->title,
            'description' => $request->description,
            'collection_id' => $request->collection_id,
            'release' => $request->release,
        ]);

        if($response->successful())
        {
            return redirect()->route('collection.show', ['id' => $request->collection_id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
