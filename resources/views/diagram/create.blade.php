@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Diagram Create</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('diagram.store')}}" method="POST">
                        @csrf
                        @method('POST')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('title', 'Title')}}
                                        {{Form::text('title', NULL, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('type', 'Type')}}
                                        {{Form::select('type', ['mindMap' => 'mindMap', 'flowChart' => 'flowChart'], null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('body', 'Body')}}
                                        {{Form::textarea('body', NULL, ['class'=>'form-control', 'id' => 'body', 'placeholder' => 'body...', 'rows' => 10, 'cols' => 80])}}
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
<script>
    $(document).ready(function () {
        $('#description').summernote();
    });
</script>
@endsection
