$(document).ready(function() {
    $.ajax({
        url: "js/GraphsAndCharts/dataEPieChart.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var day = [];
            var totalc = [];

            for (var i in data) {
                day.push(data[i].ad);
                totalc.push(data[i].adc);
            }

            var chartdata = {
                labels: day,
                datasets: [{
                    label: 'Client Seen VS not',
                    backgroundColor: ['#6d648b', '#6cbaab', '#f9a402', '#c951e9', '#eb445c', '#cbeb44'],
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: '#ebe0ff',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: totalc
                }]
            };
            var ctx = $("#myPieChartC");
            var ctx = document.getElementById("myPieChartC").getContext("2d");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartdata,
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "#6610f2",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: true,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});