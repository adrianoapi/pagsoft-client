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
                        <ul>
                            <li>titl: {{$data->title}}</li>
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
