$(document).ready(function () {



    $('#modal-desvincular').modal({
        show: false,
        backdrop: 'static'
    });


    $('#cerrarModal-desvincular').click(function () {

        $('#modal-vincular').modal('hide');
        limpiarCampos();

    });
    $('#cancelModal-desvincular').click(function () {

        $('#modal-desvincular').modal('hide');
        limpiarCampos();

    });
    $('#guardarModal-desvincular').click(function () {
        //check("info", "", "se ejecuta");
        if (document.querySelector('input[name = "radioDesvincular"]:checked') == null) {
            check("error", "Error de datos", "Debe seleccionar algún registro para ser desvinculado");
        } else {
            desvincular(document.querySelector('input[name = "radioDesvincular"]:checked').value);

        }
    });
    $('#desvincular').click(function () {

        $('#modal-desvincular').modal('show');
        $('#modal-desvincular').on('shown.bs.modal', function () {
            $('.chosen-select', this).chosen();
            $('.chosen-select-deselect', this).chosen({
                allow_single_deselect: true
            });
        });

        llenarTablaPadrinoAlumnoVinculados();
    });

});

function desvincular(idVinculacion) {
    var observaciones = document.getElementById("DesvincularObs").value;
    var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=DesvincularPadrinoAlumno" + "&desvincular=" + idVinculacion + "&DesvincularObs=" + observaciones,
        success: function (data) {
            if (!data.includes("Error")) {
                check("success", "OK", data);
                $('#modal-desvincular').modal('hide');
                limpiarCampos();
            } else {
                //tipo,titulo,mensaje
                check("error", "Error al desvincular", data);
            }
        }
    });
}

function llenarTablaPadrinoAlumnoVinculados() {
    var table = $("#PadrinoAlumnoVinculados").DataTable({
        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "ListarPadrinoAhijado"
            }
        },
        "columns": [
            {
                "data": "id",
                "render": function (data, type, full, meta) {
                    return '<input type="radio" name="radioDesvincular" value="' + data + '">';
                }
            },
            {
                "data": "idPadrino.alia"
            },
            {
                "data": "idPadrino.nombre"
            },
            {
                "data": "idPadrino.apellido"
            },
            {
                "data": "idAlumno.alias"
            },
            {
                "data": "idAlumno.nombre"
            },
            {
                "data": "idAlumno.apellido"
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ filas",
            "zeroRecords": "No se encuentran registros",
            "info": "Página _PAGE_ de _PAGES_ de _MAX_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(Filtro de _MAX_ lineas en total)",
            "sSearch": "Buscar: "
        },
    });
    table.buttons(0, null).container().prependTo(
        table.table().container()
    );

}

function limpiarCampos() {
    //para poder recargar la tabla
    var table = $('#PadrinoAlumnoVinculados').DataTable();
    table.clear().draw();
    table.destroy();
    document.getElementById("DesvincularObs").value = "";
}
