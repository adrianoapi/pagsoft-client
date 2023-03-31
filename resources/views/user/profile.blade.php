@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>name: {{$user->name}}</li>
                    <li>email: {{$user->email}}</li>
                    <li>created_at: {{$user->created_at}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
