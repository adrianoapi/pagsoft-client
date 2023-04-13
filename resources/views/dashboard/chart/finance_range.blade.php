<?php
$mes   = NULL;
$valor = NULL;
$mesD   = NULL;
$valorD = NULL;
$i=0;

$j = 0;
foreach($data as $value):
  $j++;
endforeach;

foreach($data as $key => $value):

  $virgula = $i < $j ? "," : NULL;

  $mes    = "'{$key}'{$virgula}".$mes;
  $valor  = $value->lucro.$virgula.$valor;
  $valorD = $value->despesa.$virgula.$valorD;

  $i++;

endforeach;
?>


<div class="card ">
    <div class="card-header ">
      <h4 class="card-title">Fluxo Financeiro
        <select id="financeRange" onchange="selectFinance(this)">
          <option value="annual" {{$option == "annual" ? 'selected' : NULL}}>Anual</option>
          <option value="monthly" {{$option == "monthly" ? 'selected' : NULL}}>Mensal</option>
          <option value="today" {{$option == "today" ? 'selected' : NULL}}>Diário</option>
        </select>
      </h4>
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
  var labelsFinance = [
    <?php echo $mes;?>
  ];

  var data31 = {
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

  var config3 = {
    type: 'line',
    data: data31,
    options: {}
  };
</script>

<script>
  var myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );
</script>