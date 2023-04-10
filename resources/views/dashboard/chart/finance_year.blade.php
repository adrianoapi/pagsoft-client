<?php

$mes   = NULL;
$valor = NULL;
$mesD   = NULL;
$valorD = NULL;
$i=0;

$recipe = array_reverse($data->recipe);
foreach($recipe as $value):

  $virgula = $i > 0 ? "," : NULL;

  $mes   .= "{$virgula}'{$value->dt_lancamento}'";
  $valor .= $virgula.$value->total;

  $i++;

 endforeach;
 
//Despesas
$i=0;
$expensive = array_reverse($data->expensive);
foreach($expensive as $value):

  $virgula = $i > 0 ? "," : NULL;

  $valorD .= $virgula.($value->total);

  $i++;

 endforeach;
 ?>


<div class="card ">
    <div class="card-header ">
        <h4 class="card-title">Fluxo Anual</h4>
    </div>
    <div class="card-body ">
    <canvas id="myChart3"></canvas>
    </div>
    <div class="card-footer ">
        <div class="legend">
        </div>
    </div>
</div>

<script>
  const labelsFinance = [
    <?php echo $mes;?>
  ];

  const data31 = {
    labels: labelsFinance,
    datasets: [{
      label: 'Receita',
      backgroundColor: 'rgb(0, 153, 76)',
      borderColor: 'rgb(0, 153, 76)',
      data: [<?php echo $valor;?>],
    },
    {
      label: 'Despesa',
      backgroundColor: 'rgb(204, 0, 0)',
      borderColor: 'rgb(204, 0, 0)',
      data: [<?php echo $valorD;?>],
    }]
  };

  const config3 = {
    type: 'line',
    data: data31,
    options: {}
  };
</script>

<script>
  const myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );
</script>