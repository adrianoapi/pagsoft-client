@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">CronJobs</h4>
                        <a href="{{route('cronJob.create')}}" class="btn btn-success"><i class="fa fa-file"></i> New</a>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                            <form action="{{route('cronJob.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('GET')
                                @include('partials.search')
                            </form>
                            </div>
                        </div>
                    </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>link</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>
                                        <a href="{{route('cronJob.edit', ['id' => $value->id])}}">
                                            {{$value->link}}
                                        </a>
                                        <br/>
                                        <small>{{$value->description}}</small>
                                    </td>
                                    <td>
                                        <form action="{{route('cronJob.destroy', ['id' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                            @csrf
                                            @method('delete')
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
