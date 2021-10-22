@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Ledger Entries</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-striped">
                            <thhead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thhead>
                            <tbody>
                                <? $amount = 0; ?>
                                @foreach($data as $value)
                                <tr>
                                    <? $amount += $value->price; ?>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>{{number_format($value->price, 2,',','.')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
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
