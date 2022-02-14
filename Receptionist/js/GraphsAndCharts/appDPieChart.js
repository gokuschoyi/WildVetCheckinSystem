/* layout for the doughnut chart doctor viewed count */

$(document).ready(function() {
    $.ajax({
        url: "js/GraphsAndCharts/dataDPieChart.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var day = [];
            var totalc = [];

            for (var i in data) {
                day.push(data[i].v);
                totalc.push(data[i].vC);
            }

            var chartdata = {
                labels: day,
                datasets: [{
                    label: 'Client Seen VS not',
                    backgroundColor: ['#ffcd56', '#ff6384'],
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: '#ebe0ff',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: totalc
                }]
            };
            var ctx = $("#myPieChartB");
            var ctx = document.getElementById("myPieChartB").getContext("2d");
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