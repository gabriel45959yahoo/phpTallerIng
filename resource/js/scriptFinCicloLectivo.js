$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaPadrinoAhijado();
    }

});


function loadTablaPadrinoAhijado() {




    var table = $("#PadrinosVinculados").DataTable({
        dom: 'Blfrtip',
        buttons: [

            {
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            }, {
                extend: 'excelHtml5',
                title: 'Datos de Padrino y Ahijados',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Datos de Padrino y Ahijados',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],

        "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Todo"]],
        "pagingType": "simple_numbers",
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "listaPlanCompletadoPadrino"
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
                "data": "estadoPlanPactado.fechaUltimaPaga"
            },
            {
                "data": "estadoPlanPactado.porcentajePagado",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    var porcentaje;
                    if (data == '') {
                        porcentaje = 0;
                    } else {
                        porcentaje = data;
                    }
                    return '<div class="generalProgress"><progress max="100" value="' + porcentaje + '" class="html5"></progress><p data-value="' + porcentaje + '" class="pProgress"></p></div>';
                }
            },
            {
                "data": "estadoPlanPactado.cuotasPagas"
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
    return false; // Evitar ejecutar el submit del formulario.
}
