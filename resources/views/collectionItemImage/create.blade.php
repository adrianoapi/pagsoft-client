@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="box box-bordered">
        <div class="box-title">
            <h3><i class="icon-plus-sign"></i> Adicionar</h3>

            <ul class="tabs actions">
            </ul>

        </div>

        <div class="box-content nopadding">
    
            <form action="{{route('collItemImages.store')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('POST')
                {{Form::hidden('collection_id', $data->collection_id)}}
                <input id="file-upload" type="file" name="fileUpload" accept="image/*" >
                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
                    <div id="start" >
                        <i class="fa fa-download" aria-hidden="true"></i>
                        <div>Select a file or drag here</div>
                        <div id="notimage" class="hidden">Please select an image</div>
                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                        <br>
                        <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </label>
                <input type="hidden" name="collection_item_id" value="{{$data->id}}">
            </form>

        </div>

        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span2">#</th>
                        <th class="span2">Item</th>
                        <th class="span2">Descricao</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{$data->description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-content nopadding">
            <table class="table table-hover table-nomargin">
                <thead>
                    <tr>
                        <th class="span10">Imagem</th>
                        <th class="span2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                //
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection

@section('scripts')
@endsection
