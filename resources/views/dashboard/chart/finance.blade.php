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

$dateKeySort = new ArrayObject($data);
$dateKeySort->ksort();

foreach($dateKeySort as $key => $value):

     $separetor = $i > 0 ? ',' : '';

     $date = explode('-', $key);
     $labels  .= "{$separetor}'{$date[1]}/".substr($date[0],2,2)."'";
     $cost    .= $separetor.$value->lucro;
     $receipe .= $separetor.$value->despesa;

     $i++;

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
