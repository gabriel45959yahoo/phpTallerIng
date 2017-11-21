var idrolSelect, datosChosenJson;
$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaUsuarios();
    }

//****************************iniicio carga *********************************************
    $('#guardarModal-addUsuario').click(function () {
        var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#formAddUsuario").serialize() + "&tipo=addNewUsuarios",
            success: function (data) {
                if (data.includes("correctamente")) {

                    check("success", "OK", data);
                    $('#addUsuario').modal('hide');
                    limpiarTabla();
                    loadTablaUsuarios();
                } else {

                    check("error", "Error al crear el usuario", data);
                }

            }
        });

    });
//****************************fin carga *********************************************



});


function loadTablaUsuarios() {

    cargarTablaUsuarios();

    return false; // Evitar ejecutar el submit del formulario.
}
var cargarTablaUsuarios = function () {


    var table = $("#listarAlumnos").DataTable({

        'select': {
            'style': 'single'
        },
        "processing": true,
        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "listarAlumnos"
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

                    return '<div>' + data.alias + '</div>';
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
                    var email = data.dni;
                    return '<div>' + email + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.nivelCurso + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.fechaNacimiento + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.edad + '</span></div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div>' + data.observaciones + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div id="botones-' + data.id + '" class="divBotonesTabla"><button id="editar-' + data.id + '" class="btnEditar btn btn-primary"><span class="glyphicon glyphicon-pencil"/></button></div>';
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


function limpiarTabla() {
    //para poder recargar la tabla
    var table = $('#listarAlumnos').DataTable();
    table.clear().draw();
    table.destroy();
}
//******************************************* inicio modificar ************************************************
var textId, btnGuardar, btnCancelar;
 var datosOriginal = new Array();
$(document).on('click', '.btnEditar', function () {
    textId = $(this).attr('id');
    $(this).disabled = true;
    modificarDatosTabla();

});

$(document).on('click', '.btnGuardarTabla', function () {
    btnGuardar = $(this).attr('id');
    //  check("info", "guardar", btnGuardar);
    guardarDatosTabla(btnGuardar);
    $('.btnEditar').prop('disabled', false);
});

$(document).on('click', '.btnCancelarTabla', function () {
    btnCancelar = $(this).attr('id');
    //  check("info", "guardar", btnGuardar);
    cancelarDatosTabla(btnCancelar);
    $('.btnEditar').prop('disabled', false);
});


function modificarDatosTabla() {
    var table = document.getElementById("listarAlumnos");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;

    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>'+textId.split('-')[1]+'</span>') {
                // check("info", "modificar", rows[x].cells[0].innerHTML);
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                        //pongo un formato de fecha valido para el input
                       if (text2.includes('/')) {
                           var fecha =text2.split('/');
                           var formatoFecha=fecha[2]+'-'+fecha[1]+'-'+fecha[0];
                         rows[x].cells[y].innerHTML ='<input class="inEditDateTable" type="date" name="in' + y + '" value="' + formatoFecha + '"/>';
                       }else{
                          rows[x].cells[y].innerHTML = '<input type="text" name="in' + y + '" value="' + text2 + '"/>';
                       }
                        datosOriginal[y]=text2;
                    }
                }
                $('#botones-' + textId.split('-')[1]).append('<button id="guardar-' + textId.split('-')[1] + '" class="btnGuardarTabla btn btn-success"><span class="glyphicon glyphicon-floppy-disk"/></button><button id="cancelar-' + textId.split('-')[1] + '" class="btnCancelarTabla btn btn-danger"><span class="glyphicon glyphicon-floppy-remove"/></button>');
                $('.btnEditar').prop('disabled', true);
            }


        }

    }
}

function guardarDatosTabla(btnGuardar) {
    var table = document.getElementById("listarAlumnos");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    var datosModificados = new Array();
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>'+btnGuardar.split('-')[1]+'</span>') {
                datosModificados[0] = '' + btnGuardar.split('-')[1];
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].children[0].value;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                        //pongo un formato de fecha valido
                       if (text2.includes('-') && text2.split('-').length ==3) {
                           var fecha =text2.split('-');
                           var formatoFecha=fecha[2]+'/'+fecha[1]+'/'+fecha[0];
                           datosModificados[y] = '' + formatoFecha;
                       }else{
                          datosModificados[y] = '' + rows[x].cells[y].children[0].value;
                       }
                        rows[x].cells[y].innerHTML = '<div>' + rows[x].cells[y].children[0].value + '</div>';

                    }

                }
                update_data(datosModificados);
                document.getElementById(btnGuardar).remove();
                document.getElementById('cancelar-'+btnGuardar.split('-')[1]).remove();
            }
        }


    }

}


function update_data(row) {

    var url = "../view/modificarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&row=" + row + "&tipo=datosAlumnos", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (data.includes("correctamente")) {

                check("success", "OK", data);
                limpiarTabla();
                cargarTablaUsuarios();
            } else {

                check("error", "Error al modificar los datos", data);
            }

        }
    });

}
function cancelarDatosTabla(btnCancelar){

    var table = document.getElementById("listarAlumnos");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>'+btnCancelar.split('-')[1]+'</span>') {

                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {

                        rows[x].cells[y].innerHTML = '<div>' + datosOriginal[y] + '</div>';

                    }

                }
                document.getElementById('guardar-'+btnCancelar.split('-')[1]).remove();
                document.getElementById(btnCancelar).remove();
            }
        }


    }

}
//******************************************* fin modificar ************************************************
