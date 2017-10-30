function loadTablaPadrinoAhijado() {




    var table = $("#PadrinosAhijado").DataTable({
        dom: 'Bfrtip',
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
                'tipo': "ListarPadrinoAhijado"
            }
        },
        "columns": [
            {
                "data": "idPadrino.alia"
            },
            {
                "data": "idPadrino.nombre",
                "visible": false
            },
            {
                "data": "idPadrino.apellido",
                "visible": false
            },
            {
                "data": "idAlumno.alias"
            },
            {
                "data": "idAlumno.nombre"
            },
            {
                "data": "idAlumno.apellido"
            },
            {
                "data": "idAlumno.nivelCurso"
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

    return false; // Evitar ejecutar el submit del formulario.
}
