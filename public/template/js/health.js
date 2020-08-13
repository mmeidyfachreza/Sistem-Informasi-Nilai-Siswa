var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#height').keyup(function () {
        // console.log({!! json_encode($age) !!});
        delay(function () {
            $.ajax('http://localhost:8000/api/height', {
                method: 'POST',
                global: false,
                async: false,
                dataType: 'json',
                data: {
                    height: $('#height').val(),
                    bmi: $('#bmi').val()
                }
            }).then(
                function success(data) {
                    $('#height_stat').val(data.height);
                    $('#bmi_stat').val(data.bmi);
                    console.log(data)
                }
            );
        }, 800);

        var hasil1 = $('#height').val() / 100;
        var hasil2 = $('#weight').val() / (hasil1 * hasil1);
        $('#bmi').val(hasil2.toFixed(2));
        $('#bmi2').val(hasil2.toFixed(2));
    });

    $('#weight').keyup(function () {
        // console.log({!! json_encode($age) !!});
        delay(function () {
            $.ajax('http://localhost:8000/api/weight', {
                method: 'POST',
                global: false,
                async: false,
                dataType: 'json',
                data: {
                    weight: $('#weight').val(),
                    bmi: $('#bmi').val()
                }
            }).then(
                function success(data) {
                    $('#weight_stat').val(data.weight);
                    $('#bmi_stat').val(data.bmi);
                    console.log(data)
                }
            );
        }, 800);

        var hasil1 = $('#height').val() / 100;
        var hasil2 = $('#weight').val() / (hasil1 * hasil1);
        $('#bmi').val(hasil2.toFixed(2));
        $('#bmi2').val(hasil2.toFixed(2));
    });

    $('#weight').keyup(function () {
        // console.log({!! json_encode($age) !!});
        var hasil1 = $('#height').val() / 100;
        var hasil2 = $('#weight').val() / (hasil1 * hasil1);
        $('#bmi').val(hasil2.toFixed(2));
    });
})
