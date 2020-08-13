/*global $, document, Chart, LINECHART, data, options, window*/
$(document).ready(function () {

    'use strict';

    // Main Template Color
    var brandPrimary = '#33b35a';


    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //
    var LINECHART = $('#lineCahrt');
    $.ajax({
        url: window.location.href,
        //url: "https://sikeswav2.herokuapp.com/admin",
        method: "GET",
        success: function(data) {
            console.log(data);
            var label = [];
            var valueLaki = [];
            var valuePerempuan = [];
            for (var i = 0; i < 12; i++) {
                if (typeof data.laki[i] !== 'undefined') {
                    valueLaki.push(data.laki[i].avg);
                }
                if (typeof data.perempuan[i] !== 'undefined') {
                    valuePerempuan.push(data.perempuan[i].avg);   
                }
            }
            var myLineChart = new Chart(LINECHART, {
                type: 'bar',
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes : [{
                            ticks : {    
                                
                                suggestedMin: 100,
                            }
                        }]
                    }
                },
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agus", "Sept", "Okt", "Nov", "Des"],
                    datasets: [
                        {
                            label: "Laki-laki",
                            fill: true,
                            lineTension: 0.3,
                            backgroundColor: "rgba(77, 193, 75, 0.4)",
                            borderColor: brandPrimary,
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            borderWidth: 1,
                            pointBorderColor: brandPrimary,
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: brandPrimary,
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 0,
                            data: valueLaki,
                            spanGaps: false,
                        },
                        {
                            label: "Perempuan",
                            fill: true,
                            lineTension: 0.3,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            borderWidth: 1,
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: valuePerempuan,
                            spanGaps: false,
                        }
                    ]
                }
            });
        }
    });
    
    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var PIECHART = $('#pieChart');
    var myPieChart = new Chart(PIECHART, {
        type: 'doughnut',
        data: {
            labels: [
                "First",
                "Second",
                "Third"
            ],
            datasets: [
                {
                    data: [300, 50, 100],
                    borderWidth: [1, 1, 1],
                    backgroundColor: [
                        brandPrimary,
                        "rgba(75,192,192,1)",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        brandPrimary,
                        "rgba(75,192,192,1)",
                        "#FFCE56"
                    ]
                }]
        }
    });

});
