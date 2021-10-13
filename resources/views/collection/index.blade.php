@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Striped Table with Hover</h4>
                        <p class="card-category">Here is a subtitle for this table</p>
                    </div>
                    <div class="card-body table-full-width table-responsive">
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
                                    <td><a href="{{route('collection.show', ['id' => $value->id])}}">{{$value->title}}</td>
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
                    <a href="http://127.0.0.1:8081/collection?page=1">first [{{1}}]>> </a>
                @endif
                <a href="http://127.0.0.1:8081/collection?page={{$from}}"><< prev [{{$from}}]</a>
            @endif
        </td>
        <td><li style="display: inline; ">now [{{$now}}]</li></td>
        <td>
            @if($to <= $last_page)
                <a href="http://127.0.0.1:8081/collection?page={{$to}}">next [{{$to}}]>> </a>
                @if($to <= $last_page - 1)
                    <a href="http://127.0.0.1:8081/collection?page={{$last_page}}">last [{{$last_page}}]>> </a>
                @endif
            @endif
        </td>
    </tr>
<table>




        </div>
    </div>
</div>
@endsection
