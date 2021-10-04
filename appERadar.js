$(document).ready(function() {
    $.ajax({
        url: "https://webprog.cs.latrobe.edu.au/~20306942/dataERadar.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var day = [];
            var totalc = [];

            for (var i in data) {
                day.push(data[i].pc);
                totalc.push(data[i].pcc);
            }

            var chartdata = {
                labels: day,
                datasets: [{
                    label: 'Clients',
                    backgroundColor: '#ff6384',
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: '#ebe0ff',
                    borderWidth: 3,
                    borderRadius: 10,
                    borderSkipped: false,
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: totalc
                }]
            };
            var ctx = $("#graphradar");

            var graphCanvas = new Chart(ctx, {
                type: 'doughnut',
                data: chartdata,
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
                                unit: 'day'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            },
                            maxBarThickness: 20,
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 15000,
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [1]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "#955ddf",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    },
                }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});