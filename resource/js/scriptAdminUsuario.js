//inicializamos el chosen
$(function () {

    $("#listaRol").change(function (evt, params) {
        if (params.selected != undefined) {
            check("info", "", 'selected: ' + datosChosenJson[params.selected].id);
            idrolSelect = datosChosenJson[params.selected].id;
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

    $('#guardarModal-addUsuario').click(function () {


    });

    $("#listarUsuarios").on('blur', '.update', function () {
        var id = $(this).data("id");
        var column_name = $(this).data("column");
        var value = $(this).text();

        update_data(id, column_name, value);
    });

});

function update_data(id, column_name, value) {

    var url = "../view/modificarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&usuario=" + id + "&column_name=" + column_name + "&value=" + value + "&tipo=datosUsuarios", // Adjuntar los campos del formulario enviado.
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

                    return '<div contenteditable class="update" data-id="' + data.usuario + '" data-column="usuario">' + data.usuario + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div contenteditable class="update" data-id="' + data.usuario + '" data-column="nombre">' + data.nombre + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div contenteditable class="update" data-id="' + data.usuario + '" data-column="apellido">' + data.apellido + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {
                    var email = data.email;
                    if (email == null) {
                        email = '';
                    }
                    return '<div contenteditable class="update" data-id="' + data.usuario + '" data-column="email">' + email + '</div>';
                }
            },
            {
                "data": null,
                "render": function (data, type, full, meta) {

                    return '<div contenteditable class="update" data-id="' + data.usuario + '" data-column="rol.nombre">' + data.rol.nombre + '</div>';
                }
            },
            {
                "data": "rol.descripcion",

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
                    tds = '<option value="' + i + '" class="chosen-option">' + datosChosenJson[i].descripcion + '</option>';
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
