<?php
$mes   = NULL;
$valor = NULL;
$mesD   = NULL;
$valorD = NULL;

$i=0;
$dataC = array_reverse($data->cartao);
foreach($dataC as $value):

  $virgula = $i > 0 ? "," : NULL;

  $mes   .= "{$virgula}'{$value->dt_lancamento}'";
  $valor .= $virgula.$value->total;

  $i++;

 endforeach;
 
$i=0;
$dataD = array_reverse($data->debito);
foreach($dataD as $value):

  $virgula = $i > 0 ? "," : NULL;

  $mesD   .= "{$virgula}'{$value->dt_lancamento}'";
  $valorD .= $virgula.($value->total);

  $i++;

 endforeach;
 ?>


<div class="card ">
    <div class="card-header ">
        <h4 class="card-title">Despesas Mensais</h4>
    </div>
    <div class="card-body ">
    <canvas id="myChart2"></canvas>
    </div>
    <div class="card-footer ">
        <div class="legend">
        </div>
    </div>
</div>

<script>
  const labels = [
    <?php echo $mes;?>
  ];

  const data1 = {
    labels: labels,
    datasets: [{
      label: 'Cartão de crédito',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?php echo $valorD;?>],
    }]
  };

  const data2 = {
    labels: labels,
    datasets: [{
      label: 'Cartão de crédito',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?php echo $valor;?>],
    },
    {
      label: 'Débito',
      backgroundColor: 'rgb(102, 102, 255)',
      borderColor: 'rgb(102, 102, 255)',
      data: [<?php echo $valorD;?>],
    }]
  };

  const config = {
    type: 'line',
    data: data2,
    options: {}
  };
</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart2'),
    config
  );
</script>