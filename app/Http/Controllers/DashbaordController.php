<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashbaordController extends Controller
{
    public function index()
    {
        return response()->view('dashboard.index');
    }

    public function finance()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/dashbaord/finance');
        $data = json_decode($response->getBody());

        return response()->json([
            'finance' => view('dashboard.chart.finance', ['data' => $data,])->render(),
            'table'   => view('dashboard.chart.table',   ['data' => $data,])->render(),
        ]);
    }

    public function cart()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/dashbaord/cart');
        $data = json_decode($response->getBody());
        
        return response()->json([
            'cart' => view('dashboard.chart.cart', ['data' => $data])->render(),
        ]);
    }

    public function byGroup()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/dashbaord/finance/group/'.$_GET['range']);
        $data = json_decode($response->getBody());

        return response()->json([
            'byGroup' => view('dashboard.chart.finance_group', [
                'data' => $data,
                'option' => $_GET['range']
            ])->render(),
        ]);
    }

    public function byYear()
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/dashbaord/finance/range/'.$_GET['range']);
        $data = json_decode($response->getBody());

        return response()->json([
            'byYear' => view('dashboard.chart.finance_range', [
                'data' => $data,
                'option' => $_GET['range']
            ])->render(),
        ]);
    }
}
