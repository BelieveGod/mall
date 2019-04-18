<div>
    <canvas id="myChart1" width="400" height="200"></canvas>
</div>

<script>
    $(function () {
        var data = {};
        data.type = 2;
        $.get('/admin/api/count_order_num_by_store' ,data, function(res) {
            var ctx = document.getElementById("myChart1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:res.month_date,
                    datasets: [{
                        label: '# of Votes',
                        data: res.count_num,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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
        });
    });
</script>