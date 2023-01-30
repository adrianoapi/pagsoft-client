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

                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $error }}
                        </div>
                        @endforeach

                        
                        @if(session('user_create'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!!session('user_create')!!}
                            </div>
                        @endif
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

                    <div class="card-body">
                        <p>Não Possui conta? <a href="{{Route('user.create')}}">Click aqui</a> e cadastre-se!</p>
                        <p>Esqueceu sua senha? <a href="">Clique aqui</a> e recupepre-a!</p>    
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
