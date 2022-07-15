
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card table-with-switches">
                <div class="card-header ">
                    <h4 class="card-title">Caixa mensal</h4>
                </div>
                <div class="card-body table-full-width">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data2 = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
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