<?php

include_once "header.php";

$graphdata = $db->GetSleepRange("2020-03-19 00:00:00", "2020-03-24 00:00:00");

?>
<body>
<canvas id="Graph" width="1000" height="600"></canvas>
</div>

<script>
var ctx = document.getElementById('Graph').getContext('2d');
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
    animation: false,
    scaleoverride: true,
    responsive: false,
    maintainAspectRatio: false,
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

