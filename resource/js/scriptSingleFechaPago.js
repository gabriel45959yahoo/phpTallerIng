$(function() {

    var max = moment();
    var min = moment();

    function cb(start, end) {
        $('#singleFechaPago span').html(start.format('D/M/YYYY'));

    }

    $('#singleFechaPago').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        format: "DD/MM/YYYY",
    }, cb);

    cb(max);

});
