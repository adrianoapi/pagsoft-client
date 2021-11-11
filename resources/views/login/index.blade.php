@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Login</h4></h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="card-body">
                        <form action="{{route('login.auth')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Login</label>
                                        <input type="text" name="username" class="form-control" placeholder="login" value="">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="******" value="">
                                    </div>
                                </div>
                            </div>
                            {{Form::submit('Login', ['class' => 'btn btn-info btn-fill pull-right'])}}
                            <div class="clearfix"></div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
