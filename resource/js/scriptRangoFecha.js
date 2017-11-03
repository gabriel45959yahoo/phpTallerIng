$(function() {

    var start = moment().subtract(273, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html('Desde '+start.format('D/M/YYYY') + ' hasta ' + end.format('D/M/YYYY'));
    }

    $('#reportrange').daterangepicker({
        format: "DD/MM/YYYY",
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Mes Actual': [moment().startOf('month'), moment().endOf('month')],
           'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
