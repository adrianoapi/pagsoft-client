@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Passwords</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                            <form action="{{route('collection.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('GET')
                                <div class="pull-left search"><input class="form-control" name="filter" type="text" value="{{$filter}}" placeholder="Search" /></div>
                            </form>
                            </div>
                        </div>
                    </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td><a href="{{route('password.show', ['id' => $value->id])}}">{{$value->title}}</a></td>
                                    <td>Editar</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


<table border='1'>
    <tr>
        <td>
            @if($from > 0)
                @if($now > 2)
                    <a href="/password?page=1&filter={{$filter}}">first [{{1}}]>> </a>
                @endif
                <a href="/password?page={{$from}}&filter={{$filter}}"><< prev [{{$from}}]</a>
            @endif
        </td>
        <td><li style="display: inline; ">now [{{$now}}]</li></td>
        <td>
            @if($to <= $last_page)
                <a href="/password?page={{$to}}&filter={{$filter}}">next [{{$to}}]>> </a>
                @if($to <= $last_page - 1)
                    <a href="/password?page={{$last_page}}&filter={{$filter}}">last [{{$last_page}}]>> </a>
                @endif
            @endif
        </td>
    </tr>
<table>




        </div>
    </div>
</div>
@endsection
