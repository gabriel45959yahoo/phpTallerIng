var idrolSelect, datosChosenJson, idPadrinoDomFact, idDomicilio;
var nombreTablaPadrino = 'listarPadrinos';
var nombreTablaFacturacion = 'datosfacturacion';
$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaUsuarios();
        //******************************************* inicio modal domicilio facturacion **************************
        $('#Domicilio').modal({
            show: false,
            backdrop: 'static'
        });

        $('#cerrarModal-Dom').click(function () {
            $('#Domicilio').modal('hide');
        });
        $('#cancelModal-Dom').click(function () {
            $('#Domicilio').modal('hide');
        });

        $(document).on('click', '.btnDomicilio', function () {
            idDomicilio = $(this).attr('id');
            buscarDomicilio($(this).attr('id'));
            $('#Domicilio').modal('show');

        });

        $('#guardarModal-Dom').click(function () {
            modificarDomicilio(idDomicilio);
        });


        //******************************************* fin modal domicilio facturacion ***********************************
        $('#DomicilioFact').modal({
            show: false,
            backdrop: 'static'
        });


        $('#cerrarModal-DomFact').click(function () {
            $('#Domicilio').modal('hide');
        });
        $('#cancelModal-DomFact').click(function () {
            $('#DomicilioFact').modal('hide');
        });

        $('#guardarModal-DomFact').click(function () {});

        $(document).on('click', '.btnDomicilioFact', function () {
            idPadrinoDomFact = $(this).attr('id');
            loadTableDatosFacturacion($(this).attr('id'));
            $('#DomicilioFact').modal('show');

        });
        $('#addDomFact').modal({
            show: false,
            backdrop: 'static'
        });


        $('#cerrarModal-addDomFact').click(function () {
            $('#addDomFact').modal('hide');
        });
        $('#cancelModal-addDomFact').click(function () {
            $('#addDomFact').modal('hide');
        });

        $('#guardarModal-addDomFact').click(function () {

            var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#formAddDomFact").serialize() + "&tipo=cargarDatosFacturacion" + "&idPadrino=" + idPadrinoDomFact.split('-')[1], // Adjuntar los campos del formulario enviado.
                success: function (data) {
                    if (data.includes("correctamente")) {
                        // limpiarCampos();
                        //tipo,titulo,mensaje
                        check("success", "OK", data);
                        limpiarTabla(nombreTablaFacturacion);
                        loadTableDatosFacturacion(idPadrinoDomFact);
                        $('#addDomFact').modal('hide');
                    } else {
                        //tipo,titulo,mensaje
                        check("error", "Error al cargar los datos", data);
                    }

                }
            });
        });
    }

});


function loadTablaUsuarios() {

    cargarTablaUsuarios();

    return false; // Evitar ejecutar el submit del formulario.
}
var cargarTablaUsuarios = function () {


    var table = $("#" + nombreTablaPadrino).DataTable({

        "select": {
            "style": 'single'
        },
        "processing": true,
        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "listarPadrinos"
            }
        },
        "columns": [

            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.id + '</span></div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.alia + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.nombre + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.apellido + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.dni + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.cuil + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.email + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.emailAlt + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {
                    var tel;
                    if (data.telefono == 0) {
                        tel = "";
                    } else {
                        tel = data.telefono;
                    }
                    return '<div>' + tel + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {
                    var tel;
                    if (data.telefonoAlt == 0) {
                        tel = "";
                    } else {
                        tel = data.telefonoAlt;
                    }
                    return '<div>' + tel + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.contacto + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {
                    var item;
                    if (data.fichaFisicaIngreso == 1) {
                        item = '<input type="checkbox" name="fichaFisicaIngreso-' + data.id + '" value="' + data.fichaFisicaIngreso + '" checked disabled>';
                    } else {
                        item = '<input type="checkbox" name="fichaFisicaIngreso-' + data.id + '" value="' + data.fichaFisicaIngreso + '" disabled>';
                    }
                    return '<div>' + item + '</div>';
                },
                "orderable": false
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span><button id="expandirDomicilio-' + data.id + '-' + data.domicilio + '" class="btnDomicilio"><span class="glyphicon glyphicon-plus"/></button></span></div>';
                },
                "orderable": false
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span><button id="expandirDatoFact-' + data.id + '" class="btnDomicilioFact" ><span class="glyphicon glyphicon-plus"/></button></span></div>';
                },
                "orderable": false
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div id="botones-' + data.id + '" class="divBotonesTabla"><button id="editar-' + data.id + '" class="btnEditar btn btn-primary"><span class="glyphicon glyphicon-pencil" title="Editar"/></button></div>';
                },
                "orderable": false
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


function limpiarTabla(nombreTabla) {
    //para poder recargar la tabla
    var table = $('#' + nombreTabla).DataTable();
    table.clear().draw();
    table.destroy();
}

//******************************************* inicio modificar ************************************************
var textId, btnGuardar, btnCancelar, tablaModificar;
var datosOriginal = new Array();
$(document).on('click', '.btnEditar', function () {
    textId = $(this).attr('id');
    $(this).disabled = true;
    tablaModificar = textId;
    if (tablaModificar.includes('Fact')) {
        modificarDatosTabla(nombreTablaFacturacion, textId);
    } else {
        modificarDatosTabla(nombreTablaPadrino, textId);
    }


});

$(document).on('click', '.btnGuardarTabla', function () {
    btnGuardar = $(this).attr('id');
    //  check("info", "guardar", btnGuardar);
    if (tablaModificar.includes('Fact')) {
        guardarDatosTabla(btnGuardar, nombreTablaFacturacion);
    } else {
        guardarDatosTabla(btnGuardar, nombreTablaPadrino);
    }
    $('.btnEditar').prop('disabled', false);
});

$(document).on('click', '.btnCancelarTabla', function () {
    btnCancelar = $(this).attr('id');
    //  check("info", "guardar", btnGuardar);
    if (tablaModificar.includes('Fact')) {
        cancelarDatosTabla(btnCancelar, nombreTablaFacturacion);
    } else {
        cancelarDatosTabla(btnCancelar, nombreTablaPadrino);
    }
    $('.btnEditar').prop('disabled', false);
});

$(document).on('change', '.check', function() {
  if($(this).is(':checked')){
  $('#'+$(this).attr('id')).val(1);
  }
  else{
  $('#'+$(this).attr('id')).val(0);
  }
});

function modificarDatosTabla(nombreTabla, textId) {
    var table = document.getElementById(nombreTabla);
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;

    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>' + textId.split('-')[1] + '</span>') {
                // check("info", "modificar", rows[x].cells[0].innerHTML);
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {

                        if (text2.includes('checkbox')) {
                            var text3 = rows[x].cells[y].childNodes[0].children[0].value;
                            if (text3 == 1) {
                                rows[x].cells[y].innerHTML = '<input class="check" type="checkbox" id="fichaFisicaIngreso-' + y + '" value="' + text3 + '" checked>';
                            } else {
                                rows[x].cells[y].innerHTML = '<input class="check" type="checkbox" id="fichaFisicaIngreso-' + y + '" value="' + text3 + '">';
                            }
                            //pongo un formato de fecha valido para el input
                        } else if (text2.includes('/')) {
                            var fecha = text2.split('/');
                            var formatoFecha = fecha[2] + '-' + fecha[1] + '-' + fecha[0];
                            rows[x].cells[y].innerHTML = '<input class="inEditDateTable" type="date" name="in' + y + '" value="' + formatoFecha + '"/>';
                        } else {
                            rows[x].cells[y].innerHTML = '<input type="text" name="in' + y + '" value="' + text2 + '"/>';
                        }
                        datosOriginal[y] = text2;
                    }
                }
                $('#botones-' + textId.split('-')[1]).append('<button id="guardar-' + textId.split('-')[1] + '" class="btnGuardarTabla btn btn-success"><span class="glyphicon glyphicon-floppy-disk" title="Guardar"/></button><button id="cancelar-' + textId.split('-')[1] + '" class="btnCancelarTabla btn btn-danger"><span class="glyphicon glyphicon-floppy-remove" title="Cancelar"/></button>');
                $('.btnEditar').prop('disabled', true);
            }


        }

    }
}

function guardarDatosTabla(btnGuardar, nombreTabla) {
    var table = document.getElementById(nombreTabla);
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    var datosModificados = new Array();
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>' + btnGuardar.split('-')[1] + '</span>') {
                datosModificados[0] = '' + btnGuardar.split('-')[1];
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].children[0].value;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                        //pongo un formato de fecha valido
                        if (text2.includes('-') && text2.split('-').length == 3) {
                            var fecha = text2.split('-');
                            var formatoFecha = fecha[2] + '/' + fecha[1] + '/' + fecha[0];
                            datosModificados[y] = '' + formatoFecha;
                        } else {
                            datosModificados[y] = '' + rows[x].cells[y].children[0].value;
                        }
                        rows[x].cells[y].innerHTML = '<div>' + rows[x].cells[y].children[0].value + '</div>';

                    }

                }
                update_data(datosModificados);
                document.getElementById(btnGuardar).remove();
                document.getElementById('cancelar-' + btnGuardar.split('-')[1]).remove();
            }
        }


    }

}


function update_data(row) {

    if (tablaModificar.includes('Fact')) {
        update_Fact(row);
    } else {
        update_Padrino(row);
    }


}

function update_Padrino(row) {
    var url = "../view/modificarDatos.php"; // El script a dónde se realizará la petición.
    row[row.length+1]=tablaModificar;
    $.ajax({
        type: "POST",
        url: url,
        data: "&row=" + row + "&tipo=datosPadrino", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (data.includes("correctamente")) {

                check("success", "OK", data);
                limpiarTabla(nombreTablaPadrino);
                cargarTablaUsuarios();
            } else {

                check("error", "Error al modificar los datos", data);
            }

        }
    });
}

function update_Fact(row) {
    var url = "../view/modificarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&row=" + row + "&tipo=datosFacturacion", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (data.includes("correctamente")) {

                check("success", "OK", data);
                limpiarTabla(nombreTablaFacturacion);
                loadTableDatosFacturacion(idPadrinoDomFact);
            } else {

                check("error", "Error al modificar los datos", data);
            }

        }
    });
}

function cancelarDatosTabla(btnCancelar, nombreTabla) {

    var table = document.getElementById(nombreTabla);
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>' + btnCancelar.split('-')[1] + '</span>') {

                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {

                        rows[x].cells[y].innerHTML = '<div>' + datosOriginal[y] + '</div>';

                    }

                }
                document.getElementById('guardar-' + btnCancelar.split('-')[1]).remove();
                document.getElementById(btnCancelar).remove();
            }
        }


    }

}
//******************************************* fin modificar ************************************************
//**************************************** inicio domicilio **************************************
function buscarDomicilio(idPadrino) {
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&idDomicilio=" + idPadrino.split('-')[2] + "&tipo=domicilioPadrino", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error") || !data.includes("\\")) {
                var contentJson = JSON.parse(data);

                $('#dom_calle').val(contentJson[0].calle);
                $('#dom_numero').val(contentJson[0].numero);
                $('#dom_piso').val(contentJson[0].piso);
                $('#dom_depto').val(contentJson[0].depto);
                $('#dom_provincia').val(contentJson[0].provincia);
                $('#dom_ciudad').val(contentJson[0].ciudad);

            } else {
                check("error", "Error al buscar el domicilio del Padrino", data);
            }

        }
    });
}

function modificarDomicilio(idDomicilio) {
    var url = "../view/modificarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: $("#formDom").serialize() + "&idDomicilio=" + idDomicilio.split('-')[2] + "&tipo=domicilioPadrino", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (data.includes("correctamente")) {
                check("success", "OK", data);
                $('#Domicilio').modal('hide');
            } else {
                check("error", "Error al modificar los datos", data);
            }
        }
    });
}
//**************************************** inicio domicilio Fact **************************************

function loadTableDatosFacturacion(idPadrino) {
    var tableDomFactclear = $('#' + nombreTablaFacturacion).DataTable();
    tableDomFactclear.clear().draw();
    tableDomFactclear.destroy();
    var tableDomFact = $("#" + nombreTablaFacturacion).DataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "searching": false,
        "info": false,
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "ListarDomFactPadrino",
                'idPadrino': idPadrino.split('-')[1]
            }
        },
        "columns": [
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.id + '</span></div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.nombre + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.apellido + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.dni + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.cuil + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.calle + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.numero + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.piso + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.depto + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.provincia + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.domicilio.ciudad + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div id="botones-' + data.id + '" class="divBotonesTabla"><button id="editarFact-' + data.id + '" class="btnEditar btn btn-primary"><span class="glyphicon glyphicon-pencil"/></button></div>';
                },
                "orderable": false
            }
        ],
        "language": {
            "zeroRecords": "No se encuentran registros",
            "infoEmpty": "No existen registros",

        }

    });


}
