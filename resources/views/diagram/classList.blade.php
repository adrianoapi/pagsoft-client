@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Diagrams</h4>
                        <a href="{{route('diagram.create')}}" class="btn btn-success"><i class="fa fa-file"></i> New</a>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                            <form action="{{route('diagram.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('GET')
                            </form>
                            </div>
                        </div>
                    </div>

                    @include('diagram.partials.menu')

                        <table class="table table-hover table-striped">
                            <thead>
                                <th>key</th>
                                <th>Classe</th>
                                <th>Propriedades</th>
                                <th>Métodos</th>
                            </thead>
                            <tbody>
                            @foreach($nodedata as $value)
                                <tr>
                                    <td>{{$value->key}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($value->properties as  $property)
                                                <li>{{$controller->convertVisibility($property->visibility)}} {{$property->name}}: {{$property->type}}</li>
                                            @endforeach    
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($value->methods as  $metod)
                                                <li>{{$controller->convertVisibility($metod->visibility)}} {{$metod->name}}:(
                                             
                                                    @foreach($metod->parameters as $parameter)
                                                        {{$parameter->name}}: {{$parameter->type}}
                                                    @endforeach
                                                    )
                                                </li>
                                            @endforeach   
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
