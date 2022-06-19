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
                        <form action="{{route('collection.update', ['id' => $data->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{Form::hidden('id', $data->id)}}
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('show_id', 'Show ID')}}
                                        {{Form::checkbox('show_id', true, $data->show_id)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('show_image', 'Show Image')}}
                                        {{Form::checkbox('show_image', true, $data->show_image)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('show_title', 'Show Title')}}
                                        {{Form::checkbox('show_title', true, $data->show_title)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('show_description', 'Show Description')}}
                                        {{Form::checkbox('show_description', true, $data->show_description)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('show_release', 'Show Release')}}
                                        {{Form::checkbox('show_release', true, $data->show_release)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('order', 'Order')}}
                                        {{Form::select('order', $orderList, $data->order)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('layout', 'Layout')}}
                                        {{Form::select('layout', $layoutList, $data->layout)}}
                                    </div>
                                </div>
                            </div>
                            {{Form::submit('Criar', ['class' => 'btn btn-info btn-fill pull-right'])}}
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
