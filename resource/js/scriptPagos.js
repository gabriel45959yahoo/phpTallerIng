var contentJson;
var tipoPagoSelect;
var padrinoSeleccionado;

$(document).ready(function () {
    if (!redireccionar()) {
        cargaDatosChosen();
        listaTipoPago();
    }

});

$(function () {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true

    });
});

function cargaDatosChosen() {
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.

    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=ListarPadrinoAhijado", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error") || !data.includes("\\")) {
                //check("success", "OK", data);
                contentJson = JSON.parse(data).data;
                //check("success", "OK", "Datos recuperados");
                var n = contentJson.length;
                var tds = '';
                var tds = '<optgroup label="Nombres y Apellidos" class="chosen-group">';
                tds += '<optgroup label="Padrinos" class="chosen-group">';
                for (var i = 0; i <= n - 1; i++) {
                    tds += '<option value="' + i + '" class="chosen-option">' + contentJson[i].idPadrino.alia + ', ' + contentJson[i].idPadrino.nombre + ' ' + contentJson[i].idPadrino.apellido + '</option>';
                }
                tds += '</optgroup>';

                tds += '<optgroup label="Ahijados" class="chosen-group">';
                for (var i = 0; i <= n - 1; i++) {
                    tds += '<option value="' + i + '" class="chosen-option">' + contentJson[i].idAlumno.alias + ', ' + contentJson[i].idAlumno.nombre + ' ' + contentJson[i].idAlumno.apellido + '</option>';
                }
                tds += '</optgroup>';

                $("#schedule_event").append(tds);
                /* tds='';
                 tds = '<optgroup label="Apodos"  class="chosen-group">';
                 for (var i = 0; i <= n - 1; i++) {
                    tds += '<option value="' + i + '" class="chosen-option">' + contentJson[i].idPadrino.alia + '</option>';
                    tds += '<option value="' + i + '" class="chosen-option">' + contentJson[i].idAlumno.alias + '</option>';
                 }
                  tds += '</optgroup>';
                  $("#schedule_event").append(tds);*/
                $("#schedule_event").trigger("chosen:updated");
            } else {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

        }
    });

    return false; // Evitar ejecutar el submit del formulario.
}


/**
 * Chosen de ahijados y padrinos
 * @param {[[Type]]} function ( [[Description]]
 */
$(function () {
    $("#schedule_event").change(function (evt, params) {
        if (params.selected != undefined) {
            var tableAhijado = $('#datosfacturacion').DataTable();
            tableAhijado.clear().draw();
            tableAhijado.destroy();
            //check("info", "", 'selected: ' + contentJson[params.selected].idPadrino.nombre);
            cargarDatosPadrino(params.selected);
            cargarDatosAlumno(params.selected);
            padrinoSeleccionado = params.selected;


        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
    $("#tipoPago").change(function (evt, params) {

        tipoPagoSelect = $(this).val();
    });
    $("#cargaPago").click(function () {

        var fechaPago = $('#singleFechaPago span').text();
        var observaciones = document.getElementById("observaciones").value;
        var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#formularioPago").serialize() + "&tipo=CargarPago" + "&tipoPago=" + tipoPagoSelect + "&vincular=" + contentJson[padrinoSeleccionado].id + "&fechaPago=" + fechaPago + "&observaciones=" + observaciones, // Adjuntar los campos del formulario enviado.
            success: function (data) {
                if (data.includes("correctamente")) {
                    limpiarCampos();
                    //tipo,titulo,mensaje
                    check("success", "OK", data);
                } else {
                    //tipo,titulo,mensaje
                    check("error", "Error al cargar los datos", data);
                }

            }
        });

        return false; // Evitar ejecutar el submit del formulario.
    });
});


function limpiarCampos() {
    $("#formularioPago")[0].reset(); //limpia el formulario
    $('.chosen-select').val('');
    $("#schedule_event").trigger("chosen:updated");
    var tableAhijado = $('#datosfacturacion').DataTable();
    tableAhijado.clear().draw();
    tableAhijado.destroy();
}

function cargarDatosPadrino(i) {
    $('#Palias').val(contentJson[i].idPadrino.alia);
    $("#Pnombre").val(contentJson[i].idPadrino.nombre);
    $("#Papellido").val(contentJson[i].idPadrino.apellido);
    $("#Pdni").val(contentJson[i].idPadrino.dni);
    $("#Pcuil").val(contentJson[i].idPadrino.cuil);
    obtenerDatosFacturacionPadrino(contentJson[i].idPadrino.id);
}

function cargarDatosAlumno(i) {
    $('#Aalias').val(contentJson[i].idAlumno.alias);
    $("#Anombre").val(contentJson[i].idAlumno.nombre);
    $("#Aapellido").val(contentJson[i].idAlumno.apellido);
    $("#AcursoGrado").val(contentJson[i].idAlumno.nivelCurso);

}

function obtenerDatosFacturacionPadrino(idPadrino) {

    loadTableDatosFacturacion(idPadrino);
}

function listaTipoPago() {
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=ListarTipoPago", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error")) {
                // check("success", "OK", data);
                var contentJsonTipoPago = JSON.parse(data);
                //check("success", "OK", contentJsonDomFact[0].id);
                var n = contentJsonTipoPago.length;
                if (n > 0) {
                    var tds = '';
                    for (var i = 0; i <= n - 1; i++) {
                        tds = '<option value="' + contentJsonTipoPago[i].id + '">' + contentJsonTipoPago[i].descripcion + '</option>';
                        $("#tipoPago").append(tds);

                    }

                }
            } else if (data.includes("Error")) {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

        }
    });
}


function loadTableDatosFacturacion(idPadrino) {
    var tableDomFactclear = $('#datosfacturacion').DataTable();
    tableDomFactclear.clear().draw();
    tableDomFactclear.destroy();
    var tableDomFact = $("#datosfacturacion").DataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "searching": false,
        "info": false,
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "ListarDomFactPadrino",
                'idPadrino': idPadrino
            }
        },
        "columns": [
            {
                "data": "nombre"
            },
            {
                "data": "dni"
            },
            {
                "data": "cuil"
            },
            {
                "data": "domicilio.calle"
            },
            {
                "data": "domicilio.numero"
            }
        ],
        "language": {
            "zeroRecords": "No se encuentran registros",
            "infoEmpty": "No existen registros",

        }

    });
    // tableDomFact.order([0, 'asc']).draw();

}
