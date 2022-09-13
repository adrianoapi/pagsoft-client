@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Edit</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('client.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{Form::hidden('id', $data->id)}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('name', 'Name')}}
                                    {{Form::text('name', $data->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('responsavel', 'Responsavel')}}
                                    {{Form::text('responsavel', $data->responsavel, ['class' => 'form-control', 'id' => 'responsavel', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('cpf_cnpj', 'cpf/cnpj')}}
                                    {{Form::text('cpf_cnpj', $data->cpf_cnpj, ['class' => 'form-control', 'id' => 'cpf_cnpj', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('ie', 'IE')}}
                                    {{Form::text('ie', $data->ie, ['class' => 'form-control', 'id' => 'ie', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('telefone', 'Telefone')}}
                                    {{Form::text('telefone', $data->telefone, ['class' => 'form-control', 'id' => 'telefone', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('telefone_com', 'Telefone Com')}}
                                    {{Form::text('telefone_com', $data->telefone_com, ['class' => 'form-control', 'id' => 'telefone_com', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('celular', 'Celular')}}
                                    {{Form::text('celular', $data->celular, ['class' => 'form-control', 'id' => 'celular', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('telefone', 'Telefone')}}
                                    {{Form::text('telefone', $data->telefone, ['class' => 'form-control', 'id' => 'telefone', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('email', 'e-mail')}}
                                    {{Form::text('email', $data->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('cep', 'CEP')}}
                                    {{Form::text('cep', $data->cep, ['class' => 'form-control', 'id' => 'cep', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('endereco', 'Endereço')}}
                                    {{Form::text('endereco', $data->endereco, ['class' => 'form-control', 'id' => 'endereco', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('numero', 'Número')}}
                                    {{Form::text('numero', $data->numero, ['class' => 'form-control', 'id' => 'numero', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('complemento', 'Complemento')}}
                                    {{Form::text('complemento', $data->complemento, ['class' => 'form-control', 'id' => 'complemento', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('bairro', 'Bairro')}}
                                    {{Form::text('bairro', $data->bairro, ['class' => 'form-control', 'id' => 'bairro', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('cidade', 'Cidade')}}
                                    {{Form::text('cidade', $data->cidade, ['class' => 'form-control', 'id' => 'cidade', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{Form::label('estado', 'Estado')}}
                                    {{Form::text('estado', $data->estado, ['class' => 'form-control', 'id' => 'estado', 'placeholder' => 'title...'])}}
                                </div>
                            </div>
                        </div>
                        {{Form::submit('Update', ['class' => 'btn btn-info btn-fill pull-right'])}}
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

@endsection
