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
            $('.chosen-select-deselect', this).chosen({
                allow_single_deselect: true
            });
        });
        var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.

        $.ajax({
            type: "POST",
            url: url,
            data: "&tipo=ListarPadrinoAhijado", // Adjuntar los campos del formulario enviado.
            success: function (data) {
                if (!data.includes("Error") || !data.includes("\\")) {
                    //check("success", "OK", data);
                    contentJson = JSON.parse(data);
                    //check("success", "OK", "Datos recuperados");
                    var n = contentJson.length;
                    var tds = '';
                    tds = '<optgroup label="Nombres y Apellidos" class="chosen-group">';

                    for (var i = 0; i <= n - 1; i++) {
                        tds += '<option value="' + i + '" class="chosen-option">' +
                            contentJson[i].idPadrino.nombre + ' ' + contentJson[i].idPadrino.apellido + '</option>';
                    }
                    tds += '</optgroup>';
                    $("#chosen-alumnos").append(tds);

                    tds = '';
                    tds = '<optgroup label="Apodos"  class="chosen-group">';

                    for (var i = 0; i <= n - 1; i++) {

                        tds += '<option value="' + i + '" class="chosen-option">' + contentJson[i].idPadrino.alia + '</option>';
                    }
                    tds += '</optgroup>';
                    $("#chosen-alumnos").append(tds);
                    $("#chosen-alumnos").trigger("chosen:updated");
                } else {
                    //tipo,titulo,mensaje
                    check("error", "Error al cargar los datos", data);
                }

            }
        });

    });

     $("#chosen-alumnos").change(function (evt, params) {
        if (params.selected != undefined) {
            check("info", "", 'selected: ' + contentJson[params.selected].idPadrino.nombre);


        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
});

