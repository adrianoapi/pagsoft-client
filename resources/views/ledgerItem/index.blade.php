@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Ledger Item</h4>

                    </div>
                    <div class="card-body table-full-width table-responsive">

                        <div class="fixed-table-toolbar">
                            <div class="bars pull-left">
                                <div class="toolbar">
                                    <form action="{{route('ledgerItem.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                        @csrf
                                        @method('GET')
                                        @include('partials.search')

                                        <a href="{{route('ledgerEntry.index')}}" class="btn btn-primary"><i class="nc-icon nc-money-coins"></i> Ledgers</a>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>
                                        {{$value->description}}
                                        <a href="{{route('ledgerEntry.show', ['id' => $value->ledger_entry_id])}}">Show ledger entry</a>
                                    </td>
                                    <td>{{$value->price}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td>{{$value->total_price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('partials.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
