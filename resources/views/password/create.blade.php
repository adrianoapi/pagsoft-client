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
                        <form action="{{route('password.store')}}" method="POST">
                        @csrf
                        @method('POST')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('title', 'Title')}}
                                        {{Form::text('title', '', ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('login', 'Login')}}
                                        {{Form::text('login', '', ['class' => 'form-control', 'id' => 'login', 'placeholder' => 'login...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('pass', 'Password')}}
                                        {{Form::text('pass', '', ['class' => 'form-control', 'id' => 'pass', 'placeholder' => '*****'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('url', 'URL')}}
                                        {{Form::text('url', '', ['class' => 'form-control', 'id' => 'http://www'])}}
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
