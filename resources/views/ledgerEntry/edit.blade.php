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
                        <form action="{{route('ledgerEntry.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{Form::hidden('id', $structure['data']->id)}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('description', 'Description')}}
                                        {{Form::text('description', $structure['data']->description, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'description...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('ledger_group_id', 'Ledger Group')}}
                                        {{Form::select('ledger_group_id', $structure['ledger_group'], $structure['data']->ledger_group_id)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('transition_type_id', 'Trantision Type')}}
                                        {{Form::select('transition_type_id', $structure['transition_type'], $structure['data']->transition_type_id)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('amount', 'Amount')}}
                                        {{Form::number('amount', $structure['data']->amount, ['class' => 'form-control', 'id' => 'amount', 'placeholder' => '0.00', 'step' => '0.01'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('entry_date', 'Entry date')}}
                                        {{Form::text('entry_date', $structure['data']->entry_date, ['class' => 'form-control', 'id' => 'entry_date'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('installments', 'Installments')}}
                                        {{Form::text('installments', $structure['data']->installments, ['class' => 'form-control', 'id' => 'installments'])}}
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

@endsection
