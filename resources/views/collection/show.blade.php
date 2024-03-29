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
                            @if($collection->author)
                            <a href="{{route('collection.eidt', ['id' => $collection->id])}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                            @endif
                        </h4>
                        @if($collection->author)
                        <a href="{{route('collectionItem.create', ['id' => $collection->id])}}" class="btn btn-success"><i class="fa fa-file"></i> New</a>
                        @endif
                        <p class="card-category">{!!$collection->description!!}</p>

                        <a href="{{route('collection.index')}}" class="btn btn-info"><i class="fa fa-house"></i> Voltar</a></td>
                    </div>
                    <div class="card-body">
                    <?php $count = 0; ?>
                        @if($collection->layout == "gallery")
                            @foreach ($data as $value)
                                <div class="contact-box">
                                    <a href="#new-task" onclick="showAjax({{ $value->id }})" class="btn btn-sm btn-white" data-toggle="modal" data-target="#myModal5">
                                        <div class="text-center">
                                            @if(!empty($value->images))
                                            <img alt="image" src="data:{{$value->images[0]->type}};base64, {{$value->images[0]->image}}" width="120">
                                            @endif
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
                                    <a href="{{route('collItemImages.create', ['id' => $value->id])}}">[Imagem]</a>
                                </div>
                                <?php ++$count; ?>
                            @endforeach
                        @else

                            @foreach($data as $value)
                            <table>
                                <tr>
                                    <td>
                                        @if($collection->author)
                                        <a href="{{route('collectionItem.edit', ['id' => $value->id])}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a></td>
                                        @endif
                                    <td>
                                        @if($collection->author)
                                        <form action="{{route('collectionItem.destroy', ['id' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                            @csrf
                                            @method('delete')
                                            <input name="collection_id" type="hidden" value="{{$value->collection_id}}">
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        </form>
                                        @endif
                                    </td>
                                    <td> <h3><i class="nc-icon nc-tag-content"></i> {{$value->title}}</h3></td>
                                </tr>
                            </table>
                            {!!$value->description!!}
                            <hr>
                            <?php ++$count; ?>
                            @endforeach

                        @endif
                    Total: {{$count}}
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
