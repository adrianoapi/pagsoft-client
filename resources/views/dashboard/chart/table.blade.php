

<?php
$dateKeySort = new ArrayObject($data);
$dateKeySort->ksort();
?>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Receita</th>
            <th>Despesa</th>
        </tr>
    </thead>
    @foreach($dateKeySort as $key => $value)
    <tr>
        <td>{{$key}}</td>
        <td>{{$value->lucro}}</td>
        <td>{{$value->despesa}}</td>
    </tr>
    @endforeach
</table>
