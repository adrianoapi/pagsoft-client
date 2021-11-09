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
                            <form action="{{route('password.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('GET')
                                @include('partials.search')

                                <a href="{{route('password.create')}}" class="btn btn-success"><i class="fa fa-file"></i> New</a>

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
                                    <td>
                                        <form action="{{route('password.destroy', ['id' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
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
