<?php

include_once "header.php";

$graphdata = $db->GetSleepRange("2020-03-19 00:00:00", "2020-03-24 00:00:00");

echo json_encode($graphdata);
?>
<body>
<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: <?php echo json_encode($graphdata[0]) ?>,
    datasets: [{
        label: 'Length of sleep',
        data: <?php echo json_encode($graphdata[1]) ?>,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
    }]
},
options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
}
});
</script>

</body>

