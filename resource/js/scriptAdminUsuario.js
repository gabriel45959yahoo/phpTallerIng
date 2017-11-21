//inicializamos el chosen
$(function () {

    $("#listaRol").change(function (evt, params) {
        if (params.selected != undefined) {

        }
        if (params.deselected != undefined) {
            alert('deselected: ' + params.deselected);
        }
    });
});
var idrolSelect, datosChosenJson;
$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaUsuarios();
    }
    $('#addUsuario').modal({
        show: false,
        backdrop: 'static'
    });
    //inicializamos el chosen en el modal
    $('#addUsuario').on('shown.bs.modal', function () {
        $('.chosen-select', this).chosen();
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({
            allow_single_deselect: true

        });
    });
    $('#openAddUsuario').click(function () {
        $('#addUsuario').modal('show');
        cargarChosenRol();

    });
    $('#cerrarModal-addUsuario').click(function () {

        $('#addUsuario').modal('hide');


    });
    $('#cancelModal-addUsuario').click(function () {

        $('#addUsuario').modal('hide');


    });
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


    var table = $("#listarUsuarios").DataTable({

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
                'tipo': "ListarUsuarios"
            }
        },
        "columns": [

            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.usuario + '</span></div>';
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
                    var email = data.email;
                    if (email == null) {
                        email = '';
                    }
                    return '<div>' + email + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.rol.nombre + '</span></div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div><span>' + data.rol.descripcion + '</span></div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div id="botones-' + data.usuario + '" class="divBotonesTabla"><button id="editar-' + data.usuario + '" class="btnEditar btn btn-primary"><span class="glyphicon glyphicon-pencil"/></button></div>';
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

function cargarChosenRol() {
    $("#listaRol").html('');
    $("#listaRol").trigger("chosen:updated");
    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.

    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=listarRol", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error") || !data.includes("\\")) {
                //check("success", "OK", data);
                datosChosenJson = JSON.parse(data).data;
                //check("success", "OK", "Datos recuperados");
                var n = datosChosenJson.length;
                var tds = '';
                var yaContenido = '';
                var tds = '<option value="" selected></option>';
                $("#listaRol").append(tds);
                for (var i = 0; i <= n - 1; i++) {
                    tds = '<option value="' + datosChosenJson[i].id + '" class="chosen-option">' + datosChosenJson[i].descripcion + '</option>';
                    $("#listaRol").append(tds);
                }

            } else {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

        }
    });
}

function limpiarTabla() {
    //para poder recargar la tabla
    var table = $('#listarUsuarios').DataTable();
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
    var table = document.getElementById("listarUsuarios");
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
                        rows[x].cells[y].innerHTML = '<input type="text" name="in' + y + '" value="' + text2 + '"/>';
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
    var table = document.getElementById("listarUsuarios");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    var answer = new Array();
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text == '<span>'+btnGuardar.split('-')[1]+'</span>') {
                answer[0] = '' + btnGuardar.split('-')[1];
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                        //check("info", "modificar", rows[x].cells[y].children[0].value);
                        answer[y] = '' + rows[x].cells[y].children[0].value;
                        rows[x].cells[y].innerHTML = '<div>' + rows[x].cells[y].children[0].value + '</div>';

                    }

                }
                update_data(answer);
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
        data: "&row=" + row + "&tipo=datosUsuarios", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (data.includes("correctamente")) {

                check("success", "OK", data);
            } else {

                check("error", "Error al modificar los datos", data);
            }

        }
    });

}
function cancelarDatosTabla(btnCancelar){

    var table = document.getElementById("listarUsuarios");
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
