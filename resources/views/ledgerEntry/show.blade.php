@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Ledger Entries
                            <a href="{{route('ledgerEntry.edit',  ['id' => $collection->id])}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{route('ledgerEntry.clone', ['id' => $collection->id])}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Clone</a>
                        </h4>
                        <small>{{$collection->description}} - {{$collection->entry_date}}, R${{number_format($collection->amount, 2, ',', '.')}}</small>
                    </div>

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                                <form action="{{route('ledgerItem.store')}}" method="POST" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('POST')

                                    {{Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description'))}}
                                    {{Form::number('quantity', '', array('class' => 'form-control', 'placeholder' => 'Quantity'))}}
                                    {{Form::text('price', '', array('class' => 'form-control', 'placeholder' => 'price'))}}
                                    {{Form::text('total_price', '', array('class' => 'form-control', 'placeholder' => 'total_price'))}}
                                    {{Form::hidden('ledger_entry_id', $collection->id)}}

                                    {{Form::submit('Save', ['class' => 'btn btn-primary'])}}

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-striped">
                            <thhead>
                                <tr>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thhead>
                            <tbody>
                                <? $amount = 0; ?>
                                @foreach($data as $value)
                                <tr>
                                    <? $amount += $value->total_price; ?>
                                    <td>
                                        <form action="{{route('ledgerItem.destroy', ['id' => $value->id])}}" method="POST" onSubmit="return confirm('Deseja excluir?');" style="padding: 0px;margin:0px;">
                                            @csrf
                                            @method('delete')
                                            <input name="ledger_entry_id" type="hidden" value="{{$value->ledger_entry_id}}">
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        </form>
                                    </td>
                                    <td>{{$value->description}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td>{{number_format($value->price, 2,',','.')}}</td>
                                    <td>{{number_format($value->total_price, 2,',','.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>{{number_format($amount, 2,',','.')}}</td>
                                </tr>
                            </tfoot>
                        </table>
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
