@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Colections</h4>
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
                                    <td><a href="{{route('collection.show', ['id' => $value->id])}}">{{$value->title}}</td>
                                    <td>Editar</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('partials.pagination')
        </div>
    </div>
</div>
@endsection
