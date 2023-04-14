<?php
$label   = NULL;
$dataSet = [];
$i       = 0;

foreach($data as $value):

  $virgula = $i > 0 ? ',' : '';

  $title = $i;
  $label .= "{$virgula}'{$value->title}'";
  array_push($dataSet, $value->total);

  $i++;
endforeach;

?>
<div class="card ">
    <div class="card-header ">
      <h4 class="card-title">Fluxo Financeiro
        <select onchange="selectFinanceGroup(this)">
          <option value="annual" {{$option == "annual" ? 'selected' : NULL}}>Anual</option>
          <option value="monthly" {{$option == "monthly" ? 'selected' : NULL}}>Mensal</option>
          <option value="today" {{$option == "today" ? 'selected' : NULL}}>Diário</option>
        </select>
      </h4>
    </div>
    <div class="card-body ">
    <canvas id="myChart4"></canvas>
    </div>
    <div class="card-footer ">
        <div class="legend">
        </div>
    </div>
</div>
<script>
 var data4 = {
  labels: [
    <?php echo $label;?>
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{implode(',', $dataSet)}}],
  
    hoverOffset: {{count($dataSet)}}
  }]
};
</script>

<script>
var config4 = {
  type: 'pie',
  data: data4,
};

var myChart4 = new Chart(
    document.getElementById('myChart4'),
    config4
  );
</script>