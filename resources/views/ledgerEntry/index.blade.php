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
                                    <form action="{{route('ledgerEntry.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                        @csrf
                                        @method('GET')
                                        @include('partials.search')

                                        <a href="{{route('fixedCost.index')}}" class="btn btn-primary"><i class="nc-icon nc-single-copy-04"></i> Fixed Costs</a>
                                        <a href="{{route('ledgerEntry.create')}}" class="btn btn-success"><i class="fa fa-file"></i> New</a>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>trantion</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td><pre>{{$value->entry_date}}</pre></td>
                                    <td>
                                        <a href="{{route('ledgerEntry.show', ['id' => $value->id])}}">{{$value->description}}</a>
                                        <br><small>{{$ledger_group[$value->ledger_group_id]['title']}}</small>
                                    </td>
                                    <td><pre>{{$transition_type[$value->transition_type_id]['title']}}</pre></td>
                                    <td>
                                        @if($transition_type[$value->transition_type_id]['action'] == 'expensive')
                                        <code>{{number_format($value->amount, 2, ',', '.')}}</code>
                                        @else
                                        <pre>{{number_format($value->amount, 2, ',', '.')}}</pre>
                                        @endif
                                    </td>
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
