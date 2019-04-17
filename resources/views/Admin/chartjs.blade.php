<div>
    <canvas id="myChart" width="800" height="400"></canvas>
</div>

<script>
    $(function () {
        var data = {};
        $.get('/admin/api/count_order_num_by_store' ,data, function(res){
            console.log(res.month_date);
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, ],
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