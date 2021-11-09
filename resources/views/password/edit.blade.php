@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Edit</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('password.update')}}" method="POST">
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
                                        {{Form::label('login', 'Login')}}
                                        {{Form::text('login', $data->login, ['class' => 'form-control', 'id' => 'login', 'placeholder' => 'login...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('pass', 'Password')}}
                                        {{Form::text('pass', $data->pass, ['class' => 'form-control', 'id' => 'pass', 'placeholder' => '*****'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('url', 'URL')}}
                                        {{Form::text('url', $data->url, ['class' => 'form-control', 'id' => 'http://www'])}}
                                    </div>
                                </div>
                            </div>
                            {{Form::submit('Save', ['class' => 'btn btn-info btn-fill pull-right'])}}
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

@endsection
