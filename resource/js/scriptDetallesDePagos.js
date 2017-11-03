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
            var tableAhijado = $('#detallePago').DataTable();
            tableAhijado.clear().draw();
            tableAhijado.destroy();


            var fechaDesde = $('#reportrange span').text().split(" hasta ")[0].replace("Desde ", "");
            var fechaHasta = $('#reportrange span').text().split(" hasta ")[1];

            var tableAhijado = $("#detallePago").DataTable({
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
                        "data": "montoPago"
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
            tableAhijado.order([6, 'asc']).draw();
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

function loadTablaPadrinos() {

    var table = $("#tablaPadrinos").DataTable({
        dom: 'Blfrtip',
        buttons: [

            {
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            }
        ],

        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "buscarHistoricoVinculados"
            }
        },
        "columns": [
            {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
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
                "data": "fechaAlta"
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
    table
        .order([1, 'asc'])
        .draw();


    // Add event listener for opening and closing details
    $('#tablaPadrinos tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            var tableAhijado = $('#detallePago' + row.data().id).DataTable();
            tableAhijado.clear().draw();
            tableAhijado.destroy();
            tr.removeClass('shown');
        } else {

            row.child(format(row.data())).show();
            loadTableAhijado(row.data().id);
            tr.addClass('shown');
        }
    });


    return false; // Evitar ejecutar el submit del formulario.
}

function format(d) {

    return '<div><table id="detallePago' + d.id + '" class="table" cellspacing="0" width="98%">' +
        '<thead>' +
        '<tr class="table-bordered danger">' +
        '<th class="text-center">Monto</th>' +
        '<th class="text-center">Comprobante</th>' +
        '<th class="text-center">Num. Factura</th>' +
        '<th class="text-center">Descripci&oacute;n</th>' +
        '<th class="text-center">Tipo de Pago</th>' +
        '<th class="text-center">Usuario</th>' +
        '<th class="text-center">Fecha pago</th>' +
        '<th class="text-center">Fecha registro pago</th>' +
        '</tr>' +
        '</thead>' +
        '</table></div>';
}

function loadTableAhijado(id) {
    var tableAhijado = $("#detallePago" + id).DataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "searching": false,
        "info": false,
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "detallePagosPadrinos",
                'idPadrino': id
            }
        },
        "columns": [
            {
                "data": "montoPago"
            },
            {
                "data": "idDetallePago.comprobanteAcreditaPago"
            },
            {
                "data": "idDetallePago.facturaAcreditaPago"
            },
            {
                "data": "idDetallePago.descripcion"
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
            }
        ]

    });
    tableAhijado.order([6, 'asc']).draw();

}
