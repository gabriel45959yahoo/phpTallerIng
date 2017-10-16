$(document).ready(function () {



    $('#modal-desvincular').modal({
        show: false,
        backdrop: 'static'
    });


    $('#cerrarModal-desvincular').click(function () {

        $('#modal-vincular').modal('hide');



    });
    $('#cancelModal-desvincular').click(function () {

        $('#modal-desvincular').modal('hide');


    });
    $('#guardarModal-desvincular').click(function () {
        //check("info", "", "se ejecuta");


        $('#modal-desvincular').modal('hide');

    });
    $('#desvincular').click(function () {

        $('#modal-desvincular').modal('show');
        $('#modal-desvincular').on('shown.bs.modal', function () {
            $('.chosen-select', this).chosen();
            $('.chosen-select-deselect',this).chosen({ allow_single_deselect: true });
        });

    });
});
