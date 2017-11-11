$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaVinculados();

    }

});

function loadTablaVinculados() {

    var table = $("#historicosVinculados").DataTable({
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
    $('#historicosVinculados tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            var tableAhijado = $('#historicosAhijados'+row.data().id).DataTable();
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

    return '<div><table id="historicosAhijados'+d.id+'" class="table" cellspacing="0" width="98%">' +
        '<thead>' +
        '<tr class="table-bordered danger">' +
        '<th class="text-center">Apodo</th>' +
        '<th class="text-center">Nombre</th>' +
        '<th class="text-center">Apellido</th>' +
        '<th class="text-center">Edad</th>' +
        '<th class="text-center">Grado / Curso</th>' +
        '<th class="text-center">Fecha desde</th>' +
        '<th class="text-center">Fecha hasta</th>' +
        '</tr>' +
        '</thead>' +
        '</table></div>';
}

function loadTableAhijado(id) {
    var tableAhijado = $("#historicosAhijados"+id).DataTable({
        "bLengthChange": false,
        "bPaginate": false,
        "searching": false,
        "info": false,
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
                "data": "idAlumno.alias"
            },
            {
                "data": "idAlumno.nombre"
            },
            {
                "data": "idAlumno.apellido"
            },
            {
                "data": "idAlumno.edad"
            },
            {
                "data": "idAlumno.nivelCurso"
            },
            {
                "data": "fechaAlta"
            },
            {
                "data": "fechaBaja"
            }
        ]

    });
 tableAhijado.order([6, 'asc']).draw();

}
