@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Colections</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                    <div class="fixed-table-toolbar">
                        <div class="bars pull-left">
                            <div class="toolbar">
                            <form action="{{route('collection.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                @csrf
                                @method('GET')
                                <div class="pull-left search"><input class="form-control" name="filter" type="text" value="{{$filter}}" placeholder="Search" /></div>
                            </form>
                            </div>
                        </div>
                    </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td><pre>{{$value->entry_date}}</pre></td>
                                    <td><a href="{{route('collection.show', ['id' => $value->id])}}">{{$value->description}}</td>
                                    <td><pre>{{number_format($value->amount, 2, ',', '.')}}</pre></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <table border='1'>
                            <tr>
                                <td>
                                    @if($from > 0)
                                        @if($now > 2)
                                            <a href="/ledger-entry?page=1&filter={{$filter}}">first [{{1}}]>> </a>
                                        @endif
                                        <a href="/ledger-entry?page={{$from}}&filter={{$filter}}"><< prev [{{$from}}]</a>
                                    @endif
                                </td>
                                <td><li style="display: inline; ">now [{{$now}}]</li></td>
                                <td>
                                    @if($to <= $last_page)
                                        <a href="/ledger-entry?page={{$to}}&filter={{$filter}}">next [{{$to}}]>> </a>
                                        @if($to <= $last_page - 1)
                                            <a href="/ledger-entry?page={{$last_page}}&filter={{$filter}}">last [{{$last_page}}]>> </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        <table>

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
