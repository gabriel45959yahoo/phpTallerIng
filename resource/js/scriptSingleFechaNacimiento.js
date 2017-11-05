$(function() {

    var max = moment().subtract(6, 'years');
    var min = moment().subtract(18, 'years');

    function cb(start, end) {
        $('#singleFechaNacimiento span').html(start.format('D/M/YYYY'));
    }

    $('#singleFechaNacimiento').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        format: "DD/MM/YYYY",
        startDate: max,
        minDate: min,
        maxDate: max
    }, cb);

    cb(max);

});
