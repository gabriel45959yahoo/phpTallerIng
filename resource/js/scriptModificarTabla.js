var textId, textGuardar;
$(document).on('click', '.btnEditar', function () {
    textId = $(this).attr('id');
    $(this).disabled = true;
    modificarDatosTabla();

});

$(document).on('click', '.btnGuardarTabla', function () {
    textGuardar = $(this).attr('id');
    check("info", "guardar", textGuardar);
    guardarDatosTabla();
    $('.btnEditar').prop('disabled', false);
});


function modificarDatosTabla() {
    var table = document.getElementById("listarUsuarios");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;

    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text.includes(textId.split('-')[1])) {
                check("info", "modificar", rows[x].cells[0].innerHTML);
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                        rows[x].cells[y].innerHTML = '<input type="text" name="in' + y + '" value="' + text2 + '"/>';
                    }
                }
                $('#botones-' + textId.split('-')[1]).append('<button id="guardar-' + textId.split('-')[1] + '" class="btnGuardarTabla btn btn-warning glyphicon glyphicon-floppy-disk"></button>');
                $('.btnEditar').prop('disabled', true);
            }


        }

    }
}

function guardarDatosTabla() {
    var table = document.getElementById("listarUsuarios");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    var answer = new Array();
    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text.includes(textGuardar.split('-')[1])) {
                answer[0]=''+textGuardar.split('-')[1];
                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                       //check("info", "modificar", rows[x].cells[y].children[0].value);
                        answer[y]=''+rows[x].cells[y].children[0].value;
                        rows[x].cells[y].innerHTML='<div>'+rows[x].cells[y].children[0].value+'</div>';

                    }

                }
                update_data(answer);
              document.getElementById(textGuardar).remove();
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
