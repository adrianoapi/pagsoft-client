@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Ledger Entry</h4>

                    </div>
                    <div class="card-body table-full-width table-responsive">

                        <div class="fixed-table-toolbar">
                            <div class="bars pull-left">
                                <div class="toolbar">
                                    <form action="{{route('ledgerEntry.flow')}}" method="GET" style="padding: 0px;margin:0px;">
                                        @csrf
                                        @method('GET')
                                        {{Form::select('ledger_group_id', array_merge(['' => 'Selecione...'], $ledger_group), $ledger_group_id)}}
                                        {{Form::text('entry_date_begin', $entry_date_begin, array('class' => 'form-control', 'placeholder' => 'Begin'))}}
                                        {{Form::text('entry_date_end', $entry_date_end, array('class' => 'form-control', 'placeholder' => 'End'))}}
                                        {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
                                    </form>
                                    <a href="{{route('fixedCost.index'   )}}" class="btn btn-primary"><i class="nc-icon nc-single-copy-04"></i> Fixed Costs</a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if(!empty($data))
                                            {{$data[0]->total}}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
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

function showDynamic(value)
{
    $.ajax({
        url: "{{route('dashboard.finance')}}",
        type: "GET",
        data: {
            "_token": "{{csrf_token()}}",
            "range": value
        },
        dataType: 'json',
            success: function(data){
               $("#ajax-finance").html(data['finance']);
               $("#ajax-table").html(data['table']);
            }
    });
}

</script>
@endsection
