var idPadrino;
$(document).ready(function () {
     if (!redireccionar()) {
        loadTablaPadrino();
    }


    $('#modal-vincular').modal({
        show: false,
        backdrop: 'static'
    });

    $('#cerrarModal-vincular').click(function () {

        $('#modal-vincular').modal('hide');

        limpiarCampos();
    });
    $('#cancelModal-vincular').click(function () {
 limpiarCampos();
        $('#modal-vincular').modal('hide');


  //     limpiarCamposPadrino();
 //       loadTablaPadrino();
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
//            limpiarCampos();
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

function loadTablaPadrino() {

    listarPadrinoLibres();
    return false; // Evitar ejecutar el submit del formulario.
}
var listarPadrinoLibres = function () {

    var table = $("#PadrinosLibre").DataTable({
        'initComplete': function () {

            $('#PadrinosLibre tbody').on('click', 'tr', function () {
                var $dlg = $(this);

                 $('#modal-vincular').modal('show');
                $('.modal-body', $dlg).html( " " + this.childNodes[2].innerHTML + " " + this.childNodes[3].innerHTML);
                $('h5').html("Padrino elegido: <b>" + this.childNodes[2].innerHTML + " " + this.childNodes[3].innerHTML + "</b>");
                idPadrino = this.childNodes[0].innerHTML;
               // limpiarCampos();
                listarAlumnosLibres();

            });

        },

        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "PadrinosLibres"
            }
        },
        "columns": [
            {
                "data": "id"
            },
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
                "defaultContent": '<button id="vincular" class="btn btn-primary btn-details">vincular</button>'
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

var listarAlumnosLibres = function () {
  var table = $('#AlumnosLibre').DataTable();
    table.clear().draw();
    table.destroy();
    table = $("#AlumnosLibre").DataTable({
        'select': {
            'style': 'single'
        },
        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "AlumnosLibres"
            }
        },
        "columns": [
            {
                "data": "id",
                "render": function (data, type, full, meta) {
                    return '<input type="radio" name="radioAlumno" value="' + data + '">';
                }
            },
            {
                "data": "alias"
            },
            {
                "data": "nombre"
            },
            {
                "data": "apellido"
            }
        ],

        "language": {
            "lengthMenu": "Mostrar _MENU_ filas",
            "zeroRecords": "No se encuentran registros",
            "info": "Página _PAGE_ de _PAGES_ de _MAX_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(Filtro de _MAX_ lineas en total)",
            "sSearch": "Buscar: "
        }


    });
}

function limpiarCampos() {
    //para poder recargar la tabla
    var table = $('#AlumnosLibre').DataTable();
    table.clear().draw();
    table.destroy();
    document.getElementById("observaciones").value = "";
    document.getElementById("seConocen").checked = false;
}
function limpiarCamposPadrino() {
    //para poder recargar la tabla
    var table = $('#PadrinosLibre').DataTable();
    table.clear().draw();
    table.destroy();
}
