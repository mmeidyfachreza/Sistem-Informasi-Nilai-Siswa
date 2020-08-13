$(function () {

    // Gauges

    var gauge1 = document.getElementById('gauge1');
    var gauge2 = document.getElementById('gauge2');
    var gauge3 = document.getElementById('gauge3');
    var gauge4 = document.getElementById('gauge4');

    var opts = {
        angle: 0, // The span of the gauge arc
        lineWidth: 0.06, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
            length: 0.6, // // Relative to gauge radius
            strokeWidth: 0.035, // The thickness
            color: '#fff' // Fill color
        },
        fontSize: 20,
        limitMax: false, // If false, max value increases automatically if value > maxValue
        limitMin: false, // If true, the min value of the gauge will be fixed
        colorStart: '#6F6EA0', // Colors
        colorStop: '#C0C0DB', // just experiment with them
        strokeColor: '#eee', // to see which ones work best for you
        generateGradient: false,
        scaleOverride: true,
        highDpiSupport: true // High resolution support
    };


    opts.colorStop = "#864DD9";
    var gaugeObject1 = new Donut(gauge1).setOptions(opts); // create sexy gauge!

    gaugeObject1.maxValue = 3000; // set max gauge value
    gaugeObject1.setMinValue(0); // set min value
    gaugeObject1.set(Math.floor(Math.random() * 3000)); // set actual value
    gaugeObject1.setTextField(document.getElementById("gauge1Value"));

    opts.colorStop = "#CF53F9";
    var gaugeObject2 = new Donut(gauge2).setOptions(opts); // create sexy gauge!

    gaugeObject2.maxValue = 3000; // set max gauge value
    gaugeObject2.setMinValue(0); // set min value
    gaugeObject2.set(Math.floor(Math.random() * 3000)); // set actual value - random in this case
    gaugeObject2.setTextField(document.getElementById("gauge2Value"));


    opts.colorStop = "#e95f71";
    var gaugeObject3 = new Donut(gauge3).setOptions(opts); // create sexy gauge!

    gaugeObject3.maxValue = 3000; // set max gauge value
    gaugeObject3.setMinValue(0); // set min value
    gaugeObject3.set(Math.floor(Math.random() * 3000)); // set actual value - random in this case
    gaugeObject3.setTextField(document.getElementById("gauge3Value"));


    opts.colorStop = "#7127AC";
    var gaugeObject4 = new Donut(gauge4).setOptions(opts); // create sexy gauge!

    gaugeObject4.maxValue = 3000; // set max gauge value
    gaugeObject4.setMinValue(0); // set min value
    gaugeObject4.set(Math.floor(Math.random() * 3000)); // set actual value - random in this case
    gaugeObject4.setTextField(document.getElementById("gauge4Value"));

    var intervalID = setInterval(function () {
        gaugeObject1.set(Math.floor(Math.random() * 3000))
        gaugeObject2.set(Math.floor(Math.random() * 3000))
        gaugeObject3.set(Math.floor(Math.random() * 3000))
        gaugeObject4.set(Math.floor(Math.random() * 3000))
    }, 5000);

    // Sparklines - Theme settings

    $.fn.sparkline.defaults.common.lineColor = '#864dd9';
    $.fn.sparkline.defaults.common.fillColor = '#ad91d8';
    $.fn.sparkline.defaults.common.spotColor = '#e95f71';
    $.fn.sparkline.defaults.common.minSpotColor = '#e95f71';
    $.fn.sparkline.defaults.common.maxSpotColor = '#e95f71';
    $.fn.sparkline.defaults.bar.barColor = '#864dd9';
    $.fn.sparkline.defaults.bar.stackedBarColor = ['#864dd9', '#CF53F9', '#e95f71'];
    $.fn.sparkline.defaults.box.boxFillColor = '#ad91d8';
    $.fn.sparkline.defaults.pie.sliceColors = ['#864dd9', '#CF53F9', '#e95f71'];

    // Sparklines - Init

    $('.sparklines').sparkline('html', {
        enableTagOptions: true
    });

});