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
                                <form action="{{route('ledgerEntry.index')}}" method="GET" style="padding: 0px;margin:0px;">
                                    @csrf
                                    @method('GET')
                                    <div class="pull-left search"><input class="form-control" name="filter" type="text" value="{{$filter}}" placeholder="Search" /></div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td><pre>{{$value->entry_date}}</pre></td>
                                    <td><a href="{{route('ledgerEntry.show', ['id' => $value->id])}}">{{$value->description}}</td>
                                    <td><pre>{{number_format($value->amount, 2, ',', '.')}}</pre></td>
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
