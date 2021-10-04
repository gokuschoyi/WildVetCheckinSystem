$(document).ready(function() {
    $.ajax({
        url: "https://webprog.cs.latrobe.edu.au/~20306942/dataA.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var day = [];
            var totalc = [];

            for (var i in data) {
                day.push(data[i].day);
                totalc.push(data[i].totalC);
            }

            var chartdata = {
                labels: day,
                datasets: [{
                    label: 'Clients',
                    backgroundColor: '#ff6384',
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: '#ebe0ff',
                    borderWidth: 2,
                    borderRadius: 15,
                    borderSkipped: false,
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: totalc
                }]
            };
            var ctx = $("#graphCanvasA");

            var graphCanvas = new Chart(ctx, {
                type: 'bar',
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
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            },
                            maxBarThickness: 25,
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
                                zeroLineBorderDash: [2]
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
                        backgroundColor: "rgb(255,255,255)",
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