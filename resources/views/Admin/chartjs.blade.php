<div>
    <canvas id="myChart" width="800" height="400"></canvas>
</div>

<script>
    $(function () {
        var data = {};
        data.type = 1;
        $.get('/admin/api/count_order_num_by_store' ,data, function(res){
            console.log(res.month_date);
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: res.month_date,
                    datasets: [{
                        label: '订单数',
                        data: res.count_num,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

        })
    });
</script>