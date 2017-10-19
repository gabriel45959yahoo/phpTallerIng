var idPadrino;
$(document).ready(function () {

    $('#modal-vincular').modal({
        show: false,
        backdrop: 'static'
    });

    $('#cerrarModal-vincular').click(function () {

        $('#modal-vincular').modal('hide');

        //para poder recargar la tabla
        var table = $('#AlumnosLibre').DataTable();
        table.clear().draw();
        table.destroy();

    });
    $('#cancelModal-vincular').click(function () {

        $('#modal-vincular').modal('hide');

        //para poder recargar la tabla
        var table = $('#AlumnosLibre').DataTable();
        table.clear().draw();
        table.destroy();

    });

    $('#guardarModal-vincular').click(function () {
        //check("info", "", "se ejecuta");

        if (document.querySelector('input[name = "radioAlumno"]:checked') == null) {
            check("error", "Error de datos", "Debe seleccionar un Alumno");
        } else {

            var idAlumno = document.querySelector('input[name = "radioAlumno"]:checked').value;
            var seConocenCheck = 0;
            var observaciones = document.getElementById("observaciones").value;

            if (document.getElementById("seConocen").checked) {
                seConocenCheck = 1;
            }
            guardarVinculacion(idAlumno, idPadrino, seConocenCheck, observaciones);

            $('#modal-vincular').modal('hide');

            //para poder recargar la tabla
            var table = $('#AlumnosLibre').DataTable();
            table.clear().draw();
            table.destroy();
        }
    });

});

function guardarVinculacion(idAlumno, idPadrino, seConocen, observaciones) {
    var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=Apadrinar" + "&idPadrino=" + idPadrino + "&idAlumno=" + idAlumno + "&seConocen=" + seConocen + "&observacion=" + observaciones,
        success: function (data) {
            if (!data.includes("Error")) {
                check("success", "OK", data);
            } else {
                //tipo,titulo,mensaje
                check("error", "Error al resgistrar la vinculacion", data);
            }
        }
    });
}

function loadTablaPlanes() {

    listarPlanes();
    return false; // Evitar ejecutar el submit del formulario.
}
var listarPlanes = function () {

    var table = $("#PadrinosLibre").DataTable({
        'initComplete': function () {

            $('#PadrinosLibre tbody').on('click', 'tr', function () {
                var $dlg = $(this);

                $('#modal-vincular').modal('show');
                $('.modal-body', $dlg).html(table.row(this).data().dni + " " + table.row(this).data().nombre + " " + table.row(this).data().apellido);
                $('h5').html("Padrino elegido: <b>" + table.row(this).data().nombre + " " + table.row(this).data().apellido + "</b>");
                idPadrino = table.row(this).data().id;
                listarAlumnosLibres();
            });

        },

        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "Planes"
            }
        },
        "columns": [
            {
                "data": "alia"
            },
            {
                "data": "nombre"
            },
            {
                "data": "apellido"
            },
            {
                "data": "monto"
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


}
