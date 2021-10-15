@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">
                            {{$collection->title}}
                            <small>
                                [<a href="">New</a>]
                            </small>
                        </h4>
                        <p class="card-category">{!!$collection->description!!}</p>
                    </div>
                    <div class="card-body">

                        @if($collection->layout == "gallery")
                            @foreach ($data as $value)
                                <div class="contact-box">
                                    <a href="#new-task" onclick="showAjax({{ $value->id }})" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5">
                                        <div class="text-center">
                                            <img alt="image" src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120">
                                            @if($collection->show_title)
                                            <div class="m-t-xs font-bold">{{$value->title}}</div>
                                            @endif
                                            @if($collection->show_release)
                                            <div class="m-t-xs font-bold">{{$value->release}}</div>
                                            @endif
                                            @if($collection->show_description)
                                            <div class="m-t-xs font-bold">{{$value->description}}</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else

                            @foreach($data as $value)
                                <h3>
                                    <i class="nc-icon nc-tag-content"></i> {{$value->title}}
                                    <small>
                                        [<a href="{{route('collectionItem.edit', ['id' => $value->id])}}">Edit</a>]
                                    </small>
                                    <form action="{{route('collectionItem.destroy', ['id' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                        @csrf
                                        @method('delete')
                                        <input name="collection_id" type="hidden" value="{{$value->collection_id}}">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </h3>
                                {!!$value->description!!}
                                <hr>
                            @endforeach

                        @endif

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

function qsa(sel) {
    return Array.apply(null, document.querySelectorAll(sel));
}
qsa(".code").forEach(function (editorEl) {
  CodeMirror.fromTextArea(editorEl, {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    theme: 'monokai',
  });
});

</script>
@endsection
