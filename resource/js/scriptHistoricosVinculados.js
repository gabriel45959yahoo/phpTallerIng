function loadTablaPadrinoAhijado() {

    var table = $("#historicosVinculados").DataTable({
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
    $('#historicosVinculados tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            var tableAhijado = $('#historicosAhijados').DataTable();
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

    return '<div><table id="historicosAhijados" class="table" cellspacing="0" width="98%">' +
        '<thead>' +
        '<tr class="table-bordered">' +
        '<th class="text-center">Apodo</th>' +
        '<th class="text-center">Nombre</th>' +
        '<th class="text-center">Apellido</th>' +
        '<th class="text-center">Edad</th>' +
        '<th class="text-center">Grado/Corso</th>' +
        '</tr>' +
        '</thead>' +
        '</table></div>';
}

function loadTableAhijado(id) {
    var tableAhijado = $("#historicosAhijados").DataTable({
        "ajax": {
            "method": "POST",
            "url": "../view/consultarDatos.php",
            "data": {
                'tipo': "buscarAhijadosdelPadrino",
                'idPadrino': id
            }
        },
        "columns": [
            {
                "data": "alias"
            },
            {
                "data": "nombre"
            },
            {
                "data": "apellido"
            },
            {
                "data": "edad"
            },
            {
                "data": "nivelCurso"
            }
        ]

    });


}
