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
                        <form action="{{route('cronJob.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{Form::hidden('id', $data->id)}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('client_id', 'Cliente')}}
                                    {{Form::select('client_id', $clients, $data->client_id)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('link', 'Link hppt/https')}}
                                    {{Form::text('link', $data->link, ['class' => 'form-control', 'id' => 'link', 'placeholder' => 'http://'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('description', 'Description')}}
                                    {{Form::text('description', $data->description, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'description...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('limit', 'Limit')}}
                                    {{Form::text('limit', $data->limit, ['class' => 'form-control', 'id' => 'limit', 'placeholder' => '0'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('date', 'Date')}}
                                    {{Form::text('date', $data->date, ['class' => 'form-control', 'id' => 'date', 'placeholder' => '0000-00-00'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('time', 'Time')}}
                                    {{Form::text('time', $data->time, ['class' => 'form-control', 'id' => 'time', 'placeholder' => '00:00:00'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('executed', 'Executed')}}
                                    {{Form::text('executed', $data->executed, ['class' => 'form-control', 'id' => 'executed', 'placeholder' => '0', 'disabled' => true])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('every_day', 'Every Day')}}
                                    {{Form::checkbox('every_day', true, $data->every_day)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('every_time', 'Every Time')}}
                                    {{Form::checkbox('every_time', true, $data->every_time)}}
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

@endsection
