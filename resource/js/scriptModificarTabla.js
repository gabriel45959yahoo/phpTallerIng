var textId, textGuardar;

$(document).on('click', '.btnEditar', function () {
    textId = $(this).attr('id');
    modificarDatosTabla(textId);

});

$(document).on('click', '.btnGuardarTabla', function () {
    textGuardar = $(this).attr('id');
    check("info", "guardar", textGuardar);
    guardarDatosTabla(textGuardar)
});


function modificarDatosTabla(id) {
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
            }


        }

    }
}

function guardarDatosTabla(id) {
    var table = document.getElementById("listarUsuarios");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;

    if (rowCount > 0) {
        for (var x = rowCount - 1; x > 0; x--) {
            var text = rows[x].cells[0].childNodes[0].innerHTML;

            if (text.includes(textGuardar.split('-')[1])) {

                var cellCount = rows[x].cells.length;
                for (var y = 0; y < cellCount - 1; y++) {
                    var text2 = rows[x].cells[y].childNodes[0].innerHTML;
                    var aux = rows[x].cells[y].innerHTML;
                    if (!aux.includes('<span>')) {
                       //check("info", "modificar", rows[x].cells[y].children[0].value);
                        rows[x].cells[y].innerHTML=rows[x].cells[y].children[0].value;
                    }
                }
              document.getElementById(textGuardar).remove();
            }
        }


    }

}
