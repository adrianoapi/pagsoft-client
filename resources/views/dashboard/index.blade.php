@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" id="ajax-finance">
                Loadding...
            </div>
            <div class="col-md-4" id="ajax-table">
                Loadding...
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

showDynamic('monthy');

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
