$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaDeudaPadrinosActivos();

    }

});

function loadTablaDeudaPadrinosActivos() {
    var tableDeudasPadrinos = $("#deudasPadrinos").DataTable({
        dom: 'Blfrtip',
        buttons: [

            {
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            }, {
                extend: 'copyHtml5',
                title: 'Deuda por Padrino',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "DeudaPadrinosActivos"
            }
        },
        "columns": [
            {
                "data": "idAlumno.alias"
            },
            {
                "data": "idAlumno.nombre",
                "visible": false
            },
            {
                "data": "idAlumno.apellido",
                "visible": false
            },
            {
                "data": "idPadrino.alia"
            },
            {
                "data": "idPadrino.nombre"
            },
            {
                "data": "idPadrino.apellido"
            },
            {
                "data": "estadoPlanPactado.deuda",
                "render": function (data, type, full, meta) {
                    return '$ '+ data;
                }
            },
            {
                "data": "estadoPlanPactado.porcentajePagado",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    var porcentaje;
                    if (data == '') {
                        porcentaje = 0;
                    } else {
                        porcentaje = 100-data;
                    }
                    return '<div class="generalProgress"><progress max="100" value="' + porcentaje + '" class="html5"></progress><p data-value="' + porcentaje + '" class="pProgress"></p></div>';
                }
            },
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
    tableDeudasPadrinos.order([6, 'asc']).draw();
}
