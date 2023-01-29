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
                        <form action="{{route('user.store')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>email</label>
                                        <input type="text" name="email" class="form-control" placeholder="xpto@mail.com" value="" required>
                                        @error('email')
                                        <div class="alert-danger input-xlarge">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 pl-1">
                                    <div class="form-group">
                                        <label>Password (min. 6)</label>
                                        <input type="password" name="password" class="form-control" placeholder="******" value="" required>
                                        @error('password')
                                        <div class="alert-danger input-xlarge">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 pl-1">
                                    <div class="form-group">
                                        <label>Repetir Password</label>
                                        <input type="password" name="password_check" class="form-control" placeholder="******" value="" required>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="name" value="" required>
                                        @error('name')
                                        <div class="alert-danger input-xlarge">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 pl-1">
                                    <div class="form-group">
                                        <label>Captcha: <strong>{{$captcha}}</strong></label>
                                        <input type="text" name="captcha" class="form-control" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            {{Form::submit('Cadastrar', ['class' => 'btn btn-info btn-fill pull-right'])}}
                            <a href="{{Route('login')}}">Voltar</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>

                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ $error }}
                    </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
