var datosChosenJson;
var idVinculado = null;
$(document).ready(function () {
    if (!redireccionar()) {
        cargaDatosChosenPadrinos();

    }

});

$(function () {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({
        allow_single_deselect: true

    });
    $("#listaPadrino").change(function (evt, params) {
        if (params.selected != undefined) {
            //  check("info", "", 'selected: ' + padrinoJson[params.selected].idPadrino.id);
            cargarDatosChosenAhijado(datosChosenJson[params.selected].idPadrino.id);
        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
    $("#listaAhijados").change(function (evt, params) {
        if (params.selected != undefined) {
            //  check("info", "", 'selected: ' + padrinoJson[params.selected].idPadrino.id);
            idVinculado = datosChosenJson[params.selected].id;
        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
    $("#buscarDetallePago").click(function () {

        if (idVinculado == null) {
            check("error", "Faltan Datos", 'Debe seleccionar un Padrino y uno de sus Ahijados')
        } else {
            var tableDetallePago = $('#detallePago').DataTable();
            tableDetallePago.clear().draw();
            tableDetallePago.destroy();


            var fechaDesde = $('#reportrange span').text().split(" hasta ")[0].replace("Desde ", "");
            var fechaHasta = $('#reportrange span').text().split(" hasta ")[1];

            var tableDetallePago = $("#detallePago").DataTable({
                "bLengthChange": false,
                "bPaginate": false,
                "searching": false,
                "info": false,
                "ajax": {
                    "method": "POST",
                    "url": "../view/consultarDatos.php",
                    "data": {
                        'tipo': "detallePagosPadrinos",
                        'idVinculado': idVinculado,
                        'fechaDesde': fechaDesde,
                        'fechaHasta': fechaHasta
                    }
                },
                "columns": [
                    {
                        "data": "montoPago",
                        "render": function (data, type, full, meta) {
                    return '$ '+ data;
                }
            },
                    {
                        "data": "idDetallePago.comprobanteAcreditaPago"
            },
                    {
                        "data": "idDetallePago.facturaAcreditaPago"
            },
                    {
                        "data": "idDetallePago.idTipoPago.descripcion"
            },
                    {
                        "data": "idUsuario"
            },
                    {
                        "data": "idFechaPago"
            },
                    {
                        "data": "fechaRegistro"
            },
                    {
                        "data": "idDetallePago.descripcion"
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
            tableDetallePago.order([6, 'asc']).draw();
        }
    });
});

function cargaDatosChosenPadrinos() {
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.

    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=ListarPadrinoAhijado", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error") || !data.includes("\\")) {
                //check("success", "OK", data);
                datosChosenJson = JSON.parse(data).data;
                //check("success", "OK", "Datos recuperados");
                var n = datosChosenJson.length;
                var tds = '';
                var yaContenido = '';
                var tds = '<optgroup label="Nombres y Apellidos" class="chosen-group">';

                for (var i = 0; i <= n - 1; i++) {
                    if (!yaContenido.includes(';' + datosChosenJson[i].idPadrino.id + ';')) {
                        tds += '<option value="' + i + '" class="chosen-option">' + datosChosenJson[i].idPadrino.nombre + ' ' + datosChosenJson[i].idPadrino.apellido + '</option>';
                        yaContenido += ';' + datosChosenJson[i].idPadrino.id + ';';
                    }

                }
                tds += '</optgroup>';
                $("#listaPadrino").append(tds);
                yaContenido = '';
                tds = '';
                tds = '<optgroup label="Apodos"  class="chosen-group">';
                for (var i = 0; i <= n - 1; i++) {
                    if (!yaContenido.includes(';' + datosChosenJson[i].idPadrino.id + ';')) {
                        tds += '<option value="' + i + '" class="chosen-option">' + datosChosenJson[i].idPadrino.alia + '</option>';
                        yaContenido += ';' + datosChosenJson[i].idPadrino.id + ';';
                    }

                }
                tds += '</optgroup>';
                $("#listaPadrino").append(tds);
                $("#listaPadrino").trigger("chosen:updated");
            } else {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

        }
    });

    return false; // Evitar ejecutar el submit del formulario.
}

function cargarDatosChosenAhijado(idPadrino) {
    //check("success", "OK", data);
    $("#listaAhijados").html('');
    $("#listaAhijados").trigger("chosen:updated");
    var n = datosChosenJson.length;
    var tds = '';
    var tds = '<optgroup label="Nombres y Apellidos" class="chosen-group">';
    tds += '<option value="" class="chosen-option"></option>';
    for (var i = 0; i <= n - 1; i++) {
        if (idPadrino == datosChosenJson[i].idPadrino.id) {
            tds += '<option value="' + i + '" class="chosen-option">' + datosChosenJson[i].idAlumno.nombre + ' ' + datosChosenJson[i].idAlumno.apellido + '</option>';
        }
    }
    tds += '</optgroup>';
    $("#listaAhijados").append(tds);
    tds = '';
    tds = '<optgroup label="Apodos"  class="chosen-group">';
    for (var i = 0; i <= n - 1; i++) {
        if (idPadrino == datosChosenJson[i].idPadrino.id) {
            tds += '<option value="' + i + '" class="chosen-option">' + datosChosenJson[i].idAlumno.alias + '</option>';
        }

    }
    tds += '</optgroup>';
    $("#listaAhijados").append(tds);
    $("#listaAhijados").trigger("chosen:updated");
}

