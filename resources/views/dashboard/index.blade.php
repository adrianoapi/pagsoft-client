@extends('layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7" id="ajax-finance">
                Loadding...
            </div>
            <div class="col-md-5" id="ajax-table">
                Loadding...
            </div>
        </div>
        <div class="row">
            <div class="col-md-5" id="ajax-cart">
                Loadding...
            </div>
            <div class="col-md-5" id="finance-year">
                Loadding...
            </div>
        </div>
    </div>
</div>

 
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
               
               showCart();
            }
    });
}

function showCart()
{
    $.ajax({
        url: "{{route('dashboard.cart')}}",
        type: "GET",
        data: {
            "_token": "{{csrf_token()}}"
        },
        dataType: 'json',
            success: function(data){

                $("#ajax-cart").html(data['cart']);

               showFinanceByYear("monthly");
            }
    });
}

function selectFinance(e)
{
    $("#finance-year").html('');
    showFinanceByYear(e.value);
}

function showFinanceByYear(value)
{
    $.ajax({
        url: "{{route('dashboard.finance.year')}}",
        type: "GET",
        data: {
            "_token": "{{csrf_token()}}",
            "range": value
        },
        dataType: 'json',
            success: function(data){
                $("#finance-year").html(data['byYear']);
            }
    });
}

</script>
@endsection
