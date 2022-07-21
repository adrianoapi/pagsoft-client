<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class CollectionItemImageController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = Http::withToken($this->tocken())->get(getenv('API_URL').'api/collectionItem/'.$request->id);
        $data = json_decode($response->getBody());

        return view('collectionItemImage.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fileUpload' => 'required | mimes:jpeg,jpg,png | max:1000',
        ]);

        if ($request->hasFile('fileUpload'))
        {
            $file         = $request->file('fileUpload');
            $image_base64 = base64_encode(file_get_contents($_FILES['fileUpload']['tmp_name']));
    
            $obj['image'             ] = $image_base64;
            $obj['type'              ] = $this->fileType($file->getClientOriginalName());
            $obj['size'              ] = $file->getSize();
            $obj['collection_id'     ] = $request->collection_id;
            $obj['collection_item_id'] = $request->collection_item_id;

            $response = Http::withToken($this->tocken())->post(getenv('API_URL').'api/collectionItemImage', $obj);
    
            if($response->successful())
            {
                return redirect()->route('collection.show', ['id' => $request->collection_id]);
            }else{
                dd($response->getBody()->getContents());
            }
        }
        

        return redirect()->route('collItemImages.create', ['collItem' => $collItem]);
    }

    public function fileType($value)
    {
        $formato = explode('.', $value);
        
        $tipos = array(
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "jpg" => "image/jpg",
            "php" => "text/plain",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html"=> "text/html",
            "png" => "image/png",
            "jpeg"=> "image/jpg"
        );

        $ext = NULL;
        foreach($tipos as $key => $value){
            if(end($formato) == $key){
                $ext = $value;
                break;
            }
        }

        return $ext;
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function show(CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CollectionItemImage  $collectionItemImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectionItemImage $collectionItemImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CollectionItemImage  $collItemImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = Http::withToken(session()->get('access_token'))->delete(getenv('API_URL').'api/collectionItemImage/'.$request->id, []);

        if($response->successful())
        {
            return redirect()->route('collItemImages.create', ['id' => $request->collection_item_id]);
        }else{
            dd($response->getBody()->getContents());
        }
    }
}