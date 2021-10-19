

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card table-with-switches">
                <div class="card-header ">
                    <h4 class="card-title">Caixa mensal</h4>
                </div>
                <div class="card-body table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Receita</th>
                                <th>Despesa</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $dateKeySort = new ArrayObject($data);
                        $dateKeySort->ksort();
                        $i=0;
                        ?>
                        @foreach($data as $key => $value)
                            @if($i > 6)
                            <tr>
                                <td><pre>{{date('M',strtotime($key))}}</pre></td>
                                <td class=""><pre>{{number_format($value->lucro, 2, ',', '.')}}</pre></td>
                                <td class="text-danger"><code>{{number_format($value->despesa, 2, ',', '.')}}</code></td>
                                <td>
                                    @if($value->lucro > $value->despesa)
                                        <i class="nc-icon nc-stre-up text-primary"></i>
                                    @else
                                        <i class="nc-icon nc-stre-down text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <?php
                            ++$i;
                            ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
