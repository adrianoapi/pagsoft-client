<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\UtilEloquent;
use Illuminate\Support\Facades\Http;


class ClientRepositoryEloquent extends UtilEloquent implements ClientRepositoryInterface
{
	public function getAll()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/clients',[
            'status' => 1,
        ]);

        
        return json_decode($response->getBody());
    }
}
