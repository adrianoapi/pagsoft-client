@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Create</h4>
                        <p class="card-category">Item Image</p>
                        <a href="{{route('collection.show', ['id' => $data->collection_id])}}" class="btn btn-info">Voltar</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{route('collItemImages.store')}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                {{Form::hidden('collection_id', $data->collection_id)}}
                                <input id="file-upload" type="file" name="fileUpload" accept="image/*" >
                                <label for="file-upload" id="file-drag">
                                    <div id="start" >
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <span class="text-danger">{{ $errors->first('fileUpload') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </label>
                                <input type="hidden" name="collection_item_id" value="{{$data->id}}">
                            </form>
                        </div>
                        <div class="row">
                            <table class="table table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Item</th>
                                        <th class="">Descricao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{!!$data->description!!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table class="table table-hover table-nomargin">
                                <thead>
                                    <tr>
                                        <th class="">Imagem</th>
                                        <th class="">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data->images as $value)
                                        <tr>
                                            <td><img src="data:{{$value->type}};base64, {{$value->image}}" width="120" alt="" /></td>
                                            <td>
                                                {{ Form::open(['route' => ['collItemImages.destroy', $value->id],  'method' => 'POST', 'onSubmit' => "return confirm('Deseja excluir?');", 'style' => 'padding: 0px;margin:0px;']) }}
                                                    @csrf
                                                    @method('delete')
                                                    {{Form::hidden('collection_item_id', $data->id)}}
                                                    <button type="submit" class="btn btn-inverse"><i class="icon-trash"></i> Excluir</button>
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
