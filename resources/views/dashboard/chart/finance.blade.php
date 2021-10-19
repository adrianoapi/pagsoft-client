<div class="card ">
    <div class="card-header ">
        <h4 class="card-title">Finance</h4>
    </div>
    <div class="card-body ">
        <div id="chartActivity" class="ct-chart"></div>
    </div>
    <div class="card-footer ">
        <div class="legend">
            <i class="fa fa-circle text-info"></i> Receipe
            <i class="fa fa-circle text-danger"></i> Cost
        </div>
    </div>
</div>
<?php
$labels  = NULL;
$dates   = NULL;
$recipe  = NULL;
$cost    = NULL;
$receipe = NULL;

$i = 0;
$j = 0;

$dateKeySort = new ArrayObject($data);
$dateKeySort->ksort();

foreach($data as $key => $value):
    if($j > 2)
    {
        $separetor = $i > 0 ? ',' : '';

        $labels  .= "{$separetor}'".date("M", strtotime($key))."'";
        $cost    .= $separetor.$value->lucro;
        $receipe .= $separetor.$value->despesa;

        $i++;
    }
    ++$j;
endforeach;

?>

<script type="text/javascript">

    var data = {
            labels: [<?php echo $labels; ?>],
            series: [
                [<?php echo $cost; ?>],
                [<?php echo $receipe; ?>]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: true
            },
            height: "295px",
        };

        var responsiveOptions = [
            ['screen and (max-width: 840px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];

        var chartActivity = Chartist.Bar('#chartActivity', data, options, responsiveOptions);

</script>
