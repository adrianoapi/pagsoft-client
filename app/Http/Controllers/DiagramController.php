<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagramController extends UtilController
{
    public function index(Request $request)
    {
        $filter = !empty($request->filter) ? $request->filter : null;
        $page   = !empty($request->page) ? $request->page : 1;
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/diagram',[
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

        return response()->view('diagram.index', $structure);
    }

    public function create()
    {
        return response()->view('diagram.create');
    }

    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->post(getenv('API_URL').'api/diagram', [
            'title' => $request->title,
            'type'  => $request->type,
            'body'  => $request->body
        ]);

        if($response->successful())
        {
            $data = json_decode($response->getBody());
            return redirect()->route('diagram.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }

    public function show(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->get(getenv('API_URL').'api/diagram/'.$request->id);
        $data = json_decode($response->getBody());

        $diagram = $data->diagram;
        
        if($diagram->type == 'mindMap'){

            $json = NULL;
            $json .=  '{ "class": "TreeModel",
                "nodeDataArray": [';
            $json .=  "\n";
            $limit = count($data->items);
            $i = 0;
            foreach($data->items as $item):
                $i++;
                $json .=  '{';
                $json .=  '"key":'.$item->key.',';
                if(is_numeric($item->parent)){
                    $json .=  '"parent":'.$item->parent.',';
                }
                if(!empty($item->text)){
                    $json .=  '"text":"'.preg_replace( "/\r|\n/", "", $item->text ).'",';
                }
                if(!empty($item->brush)){
                    $json .=  '"brush":"'.$item->brush.'",';
                }
                if(!empty($item->dir)){
                    $json .=  '"dir":"'.$item->dir.'",';
                }
                if(!empty($item->loc)){
                    $json .=  '"loc":"'.$item->loc.'"';
                }
                $json .=  '}';

                if($i < $limit){
                    $json .=  ',';
                }

            endforeach;
            $json .=  ']}';
            $page = 'diagram.show';

        }else{

            $json = NULL;
            $json .=  '{ "class": "go.GraphLinksModel",
                "linkFromPortIdProperty": "fromPort",
                "linkToPortIdProperty": "toPort",
                "nodeDataArray": [';
            $json .=  "\n";
            $limit = count($data->items);
            $i = 0;
            foreach($data->items as $item):
                $i++;
                $json .=  '{';
                if(!empty($item->category)){
                    $json .=  '"category":"'.$item->category.'",';
                }
                if(is_numeric($item->key)){
                    $json .=  '"key":'.$item->key.',';
                }
                if(!empty($item->text)){
                    $json .=  '"text":"'.preg_replace( "/\r|\n/", "", $item->text ).'",';
                }
                if(!empty($item->loc)){
                    $json .=  '"loc":"'.$item->loc.'"';
                }
                $json .=  '}';

                if($i < $limit){
                    $json .=  ',';
                }

            endforeach;

            $json .=  '],';
            $json .=  '"linkDataArray": [';

            $j = 0;
            $linkDataLimit = count($data->linkData);
            foreach($data->linkData as $item):
                $j++;
                $json .=  '{';
                if(!empty($item->from)){
                    $json .=  '"from":'.$item->from.',';
                }
                if(is_numeric($item->to)){
                    $json .=  '"to":'.$item->to.',';
                }
                if(!empty($item->fromPort)){
                    $json .=  '"fromPort":"'.$item->fromPort.'",';
                }
                if(!empty($item->toPort)){
                    $json .=  '"toPort":"'.$item->toPort.'"';
                }
                if(!empty($item->visible)){
                    $json .=  ',"visible":"'.$item->visible.'"';
                }
                if(!empty($item->text)){
                    $json .=  ',"text":"'.$item->text.'"';
                }

                $json .=  '}';

                if($j < $linkDataLimit){
                    $json .=  ',';
                }

            endforeach;
            $json .=  ']}';
            $page = 'diagram.showFlowChart';
        }

        return view($page, ['diagram' => $diagram,'body' => $json]);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagram  $diagram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagram $diagram)
    {
        DiagramItem::where('diagram_id', $diagram->id)->delete();
        DiagramLinkData::where('diagram_id', $diagram->id)->delete();



        $item = json_decode($request->body);

        if($diagram->type == 'mindMap'){
            foreach($item->nodeDataArray as $item):

                $modelItem = new DiagramItem();
                $modelItem->diagram_id = $diagram->id;
                $modelItem->key = $item->key;
                if(array_key_exists('parent', $item)){
                    $modelItem->parent = $item->parent;
                }
                if(array_key_exists('text', $item)){
                    $modelItem->text = $item->text;
                }
                if(array_key_exists('brush', $item)){
                    $modelItem->brush = $item->brush;
                }
                if(array_key_exists('dir', $item)){
                    $modelItem->dir = $item->dir;
                }
                if(array_key_exists('loc', $item)){
                    $modelItem->loc = $item->loc;
                }
                $modelItem->save();

            endforeach;
        }else{

            foreach($item->linkDataArray as $value):

                $modelLink = new DiagramLinkData();
                $modelLink->diagram_id = $diagram->id;
                if(array_key_exists('from', $value)){
                    $modelLink->from = $value->from;
                }
                if(array_key_exists('to', $value)){
                    $modelLink->to = $value->to;
                }
                if(array_key_exists('fromPort', $value)){
                    $modelLink->fromPort = $value->fromPort;
                }
                if(array_key_exists('toPort', $value)){
                    $modelLink->toPort = $value->toPort;
                }
                if(array_key_exists('visible', $value)){
                    $modelLink->visible = $value->visible;
                }
                if(array_key_exists('text', $value)){
                    $modelLink->text = $value->text;
                }
                $modelLink->save();

            endforeach;

            foreach($item->nodeDataArray as $item):

                $modelItem = new DiagramItem();
                $modelItem->diagram_id = $diagram->id;
                $modelItem->key = $item->key;
                if(array_key_exists('category', $item)){
                    $modelItem->category = $item->category;
                }
                if(array_key_exists('text', $item)){
                    $modelItem->text = $item->text;
                }
                if(array_key_exists('loc', $item)){
                    $modelItem->loc = $item->loc;
                }
                $modelItem->save();

            endforeach;

        }

        return redirect()->route('diagrams.index');
    }

    public function delete(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/diagram/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('diagrams.index');
        }else{
            dd($response->getBody()->getContents());
        }
    }
}
