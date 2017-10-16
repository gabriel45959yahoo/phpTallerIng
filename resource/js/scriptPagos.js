var contentJson;
var tipoPagoSelect;

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
                contentJson = JSON.parse(data);
                //check("success", "OK", "Datos recuperados");
                var n = contentJson.length;

                var tds = '';
                for (var i = 0; i <= n - 1; i++) {
                    tds = '<option value="' + i + '">' + contentJson[i].idPadrino.nombre + ' ' + contentJson[i].idPadrino.apellido + '</option>';
                    tds += '<option value="' + i + '">' + contentJson[i].idPadrino.alia + '</option>';
                    tds += '<option value="' + i + '">' + contentJson[i].idAlumno.nombre + ' ' + contentJson[i].idAlumno.apellido + '</option>';
                    tds += '<option value="' + i + '">' + contentJson[i].idAlumno.alias + '</option>';
                    $("#schedule_event").append(tds);

                }
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
            //check("info", "", 'selected: ' + contentJson[params.selected].idPadrino.nombre);
            cargarDatosPadrino(params.selected);
            cargarDatosAlumno(params.selected);

        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
    $("#tipoPago").change(function (evt, params) {
        // check("info", "", 'selected: ' + $(this).val());
        tipoPagoSelect = $(this).val();
    });
    $("#cargaPago").click(function () {
        var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
        $.ajax({
           type: "POST",
           url: url,
           data: $("#formularioPago").serialize()+"&tipo=CargarPago", // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               if(data.includes("correctamente")){
                        $("#formularioPago")[0].reset();//limpia el formulario
                        //tipo,titulo,mensaje
                       check("success","OK",data);
                    }else{
                        //tipo,titulo,mensaje
                        check("error","Error al cargar los datos",data);
                    }

           }
         });

    return false; // Evitar ejecutar el submit del formulario.
 });
});




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
    limpiartablaDomFact();
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=ListarDomFactPadrino&idPadrino=" + idPadrino, // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error")) {
                // check("success", "OK", data);
                var contentJsonDomFact = JSON.parse(data);
                //check("success", "OK", contentJsonDomFact[0].id);
                var n = contentJsonDomFact.length;
                if (n > 0) {
                    var tds = '<tbody> ';
                    for (var i = 0; i <= n - 1; i++) {
                        tds = '<tr>';
                        tds += '<td style="display:none;">' + contentJsonDomFact[i].id + '</td>';
                        tds += '<td>' + contentJsonDomFact[i].nombre + ' ' + contentJsonDomFact[i].apellido + ' ' + '</td>';
                        tds += '<td>' + contentJsonDomFact[i].dni + '</td>';
                        tds += '<td>' + contentJsonDomFact[i].cuil + '</td>';
                        tds += '<td>' + contentJsonDomFact[i].domicilio.calle + '</td>';
                        tds += '<td>' + contentJsonDomFact[i].domicilio.numero + '</td>';
                        tds += '</tr>';
                        $("#tablaDatosFacturacion").append(tds);

                    }
                    tds += '</tbody>';
                }
            } else if (data.includes("Error")) {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

        }
    });
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

function limpiartablaDomFact() {
    var table = document.getElementById("tablaDatosFacturacion");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            table.deleteRow(x);
        }
    }
}
