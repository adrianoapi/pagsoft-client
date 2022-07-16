<?php
$mes   = NULL;
$valor = NULL;
$i=0;
$data = array_reverse($data);
foreach($data as $value):

  $virgula = $i > 0 ? "," : NULL;

  $mes   .= "{$virgula}'{$value->dt_lancamento}'";
  $valor .= $virgula.$value->total;

  $i++;

 endforeach;

 ?>


<div class="card ">
    <div class="card-header ">
        <h4 class="card-title">Finance</h4>
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

  const data2 = {
    labels: labels,
    datasets: [{
      label: 'Cartão de crédito',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?php echo $valor;?>],
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