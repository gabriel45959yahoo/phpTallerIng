$(document).ready(function () {
    if (!redireccionar()) {
        loadTablaPadrinoAhijado();

    }

});


function loadTablaPadrinoAhijado() {


    var table = $("#PadrinosVinculados").DataTable({
        'initComplete': function () {

          // asignarEvento();

        },
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
                "data": "idAlumno.nombre"
            },
            {
                "data": "idAlumno.apellido"
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
                "data": null,
                "render": function (data, type, full, meta) {
                    var porcentaje;
                    if (data.estadoPlanPactado.porcentajePagado == '') {
                        porcentaje = 0;
                    } else {
                        porcentaje = data.estadoPlanPactado.porcentajePagado;
                    }

                    if (porcentaje < 100) {
                        return '<div title="Aportes incompletos"><button class="btn btn-warning"  id="custom-confirmation-' + data.id + '">Finalizar</button></div>';
                    } else {
                        return '<div title="Aportes Completos" ><button class="btn btn-success" id="custom-' + data.id + '">Finalizar</button></div>';
                    }

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
    table
        .order([1, 'asc'])
        .draw();

    return false; // Evitar ejecutar el submit del formulario.
}

$(document).on('click', '.btn', function () {
var currency = '', btnFinalizar = $(this).attr('id');
    if(btnFinalizar.includes('confirmation')){
             $('#' + btnFinalizar).confirmation({
                rootSelector: '#' + btnFinalizar,
                container: 'body',
                title: '¿Seguro que desea Finalizar el ciclo lectivo?',
                onConfirm: function (currency) {
                    if(currency.includes('SI')){
                         check("error", "OK", btnFinalizar);
                       }else{
                         check("info", "OK", btnFinalizar);
                       }

                },
                buttons: [
                    {
                        class: 'btn btn-primary',
                        label: 'NO',
                        value: 'NO'
                    },
                    {
                        class: 'btn btn-success',
                        label: 'SI',
                        value: 'SI'
                    }
                ]
            });
       $('#'+btnFinalizar).confirmation('show')
    }else if(!btnFinalizar.includes('Todos')){
       check("info", "OK", "se actualiza");
    }else{
        check("info", "OK", "Fueron todos");
    }
});
