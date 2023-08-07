<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Ringkasan pendapatan</h6>

            <!-- Filter form -->
            <form method="post" action="<?= base_url('dashboard'); ?>">
                <div class="d-flex">
                    <select class="form-control" name="id_dorm">
                        <option value="">All Asrama</option>
                        <?php foreach ($dorms as $dorm): ?>
                            <option value="<?= $dorm["id"] ?>"><?= $dorm["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <button class="btn btn-secondary ml-2" type="submit">Apply</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <canvas id="earningsChart"></canvas>
    </div>
</div>

<script>        
        var data = <?php echo json_encode($earnings); ?>;
        var months_spell = ["January", "February", "March", "April","May", "June", "July", "August","September", "October", "November", "December"];
        var months = [];
        var earnings = [];

        data.forEach(function(item) {
            months.push(months_spell[item.month - 1] + " " + item.year);
            earnings.push(item.total_earnings);
        });

        var ctx = document.getElementById('earningsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: earnings,
                }],
            },
            options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    }).format(value);;
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ':' + new Intl.NumberFormat('id-ID', {
                                                style: 'currency',
                                                currency: 'IDR',
                                                }).format(tooltipItem.yLabel);
        }
      }
    }
  }
        });
    </script>