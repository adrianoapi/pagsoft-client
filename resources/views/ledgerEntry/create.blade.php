@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Create</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('ledgerEntry.store')}}" method="POST">
                        @csrf
                        @method('POST')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        {{Form::text('description', '', ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'description...'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ledger Group</label>
                                        {{Form::select('ledger_group_id', $data['ledger_group'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Trantision Type</label>
                                        {{Form::select('transition_type_id', $data['transition_type'],)}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        {{Form::number('amount', '', ['class' => 'form-control', 'id' => 'amount', 'placeholder' => '0.00', 'step' => '0.01'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Entry date</label>
                                        {{Form::text('entry_date', date('Y-m-d'), ['class' => 'form-control', 'id' => 'entry_date'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Installments</label>
                                        {{Form::text('installments', 0, ['class' => 'form-control', 'id' => 'installments'])}}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
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
