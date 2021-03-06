@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Edit</h4>
                        <p class="card-category">{{$data->title}}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('collectionItem.update', ['id' => $data->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{Form::hidden('collection_id', $data->collection_id)}}
                        {{Form::hidden('release', $data->release)}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('title', 'Title')}}
                                        {{Form::text('title', $data->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('description', 'Description')}}
                                        {{Form::textarea('description', $data->description, ['class'=>'form-control', 'id' => 'description', 'placeholder' => 'description...', 'rows' => 4, 'cols' => 80])}}
                                    </div>
                                </div>
                            </div>
                            {{Form::submit('Update', ['class' => 'btn btn-info btn-fill pull-right'])}}
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#description').summernote();
    });
</script>
@endsection
