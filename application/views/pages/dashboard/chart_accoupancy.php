<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Okupansi Asrama</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Get data from PHP and convert it to a JavaScript array
    var chartData = <?php echo json_encode($list_summary_room); ?>;
    var labels = [];
    var values = [];
    var backgroundColors = [];

    // Process data
    for (var i = 0; i < chartData.length; i++) {
        labels.push(chartData[i].dorm_name);
        values.push(parseInt(chartData[i].occupancy));
        // Generate random background color for each bar
        var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
        backgroundColors.push(randomColor);
    }

    console.log("labels", labels);
    console.log("values", values);

    // Create the chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: values,
                backgroundColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                    display: false // Disable dataset label display
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        max: 100,
                        callback: function (value) {
                            return value + '%';
                        }
                    }
                }]
            }
        }
    });
</script>