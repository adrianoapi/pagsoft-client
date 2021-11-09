@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Passwords <a href="{{route('password.edit', ['id' => $data->id])}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a></h4>
                    </div>

                    <div class="card-body table-full-width table-responsive">
                        <ul>
                            <li>title: {{$data->title}}</li>
                            <li>login: {{$data->login}}</li>
                            <li>pass: {{$data->pass}}</li>
                            <li>url: {{$data->url}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
