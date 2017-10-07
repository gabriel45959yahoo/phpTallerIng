/**
 * Es el paginador de la tabla de padrinos libres
 */
function paginartablaPadrinos() {
    $('#tablaPadrinos').after('<div id="nav"></div>');
    var rowsShown = 6;
    var rowsTotal = $('#tablaPadrinos tbody tr').length - 1;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
        var pageNum = i + 1;
        $('#nav').append('<li><a href="#" rel="' + i + '">' + pageNum + '</a></li>');
    }

    $('#tablaPadrinos tbody tr').hide();
    $('#tablaPadrinos thead tr').slice(0, rowsShown).show();
    $('#tablaPadrinos tbody tr').slice(0, rowsShown).show();
    $('#nav li a:first').addClass('active');
    $('#nav a').bind('click', function () {

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#tablaPadrinos tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
        css('display', 'table-row').animate({
            opacity: 1
        }, 300);
    });
}
function loadTablaPadrino(){
     var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
        var table = document.getElementById("tablaPadrinos");
        var rows = table.getElementsByTagName("TR");
        var rowCount = rows.length-1;
        if (rowCount > 1) {
            for (var x = rowCount ; x > 0; x--) {
                table.deleteRow(x);
            }

            $('#nav').remove();
        }
        $.ajax({
            type: "POST",
            url: url,
            data: "&tipo=PadrinosLibres", // Adjuntar los campos del formulario enviado.
            success: function (data) {
                if (!data.includes("Error")) {
                    var content = JSON.parse(data);
                    //check("success", "OK", "Datos recuperados");
                    var n = content.length;

                    var tds = '<tbody> ';
                    for (var i = 0; i <= n-1; i++) {
                        tds = '<tr>';
                        tds += '<td>' + content[i].alia + '</td>';
                        tds += '<td>' + content[i].nombre + '</td>';
                        tds += '<td>' + content[i].apellido + '</td>';
                        tds += '<td>' + content[i].dni + '</td>';
                        tds += '<td>' + ' ' + '</td>';
                        tds += '<td><button type="button" class="btn" id="myBtn" data-toggle="modal" data-target="#Ahijado" data-show="true" onclick = "mostrarModalAlumnos(' + (i + 1) + ')">asignar</button></td>';
                        tds += '</tr>';
                        $("#tablaPadrinos").append(tds);

                    }
                    tds += '</tbody>';

                   paginartablaPadrinos();

                } else {
                    //tipo,titulo,mensaje
                    check("error", "Error al cargar los datos", data);
                }

            }
        });

        return false; // Evitar ejecutar el submit del formulario.
}


/**
 * Para mostrar la pantalla de alumnos a seleccionar para el padrino libre elegido
 * @param {[[Type]]} id [[Description]]
 */
function mostrarModalAlumnos(id) {
    limpiarModalAlumnos();
    var table = document.getElementById("tablaPadrinos");
    var rows = table.getElementsByTagName("TR");
    var apodo = rows[id].getElementsByTagName("TD")[0];
    var nombre = rows[id].getElementsByTagName("TD")[1];
    var apellido = rows[id].getElementsByTagName("TD")[2];

    $("#apadrinarAlumno").html("Padrino elegido: <b>" + nombre.innerHTML + " " + apellido.innerHTML+"</b>"); // Mostrar la respuestas del script PHP.

    var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=AlumnosLibres", // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error")) {
                var content = JSON.parse(data);
                //$("#formularioPadrinosLibres")[0].reset();//limpia el formulario
                //tipo,titulo,mensaje
               // check("success", "OK", "Datos recuperados");
                var n = content.length;
                var tds;
                for (var i = 0; i < n; i++) {
                    var alumno = content[i].nombre + " " + content[i].apellido;
                    tds = '<tr>';
                    //en el value se colocan los id del alumno y el padrino, para poder asociarlos
                    tds +='<td><input type="radio" name="radioAlumno" value="'+alumno+"*" + content[i].id+"*"+id+ '">' + alumno + '</td>';
                  //  tds +='<td>' + alumno + '</td>';
                    tds += '</tr>';
                    $("#tablaAlumnosLibres").append(tds);
                }

            } else {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }


        }
    });

}
/**
 * Cuando se guarda la asociacion entre padrino y alumno
 */
function guardarApadrinaje() {
    var select=document.querySelector('input[name = "radioAlumno"]:checked').value;
    check("info", "OK", select.split("*")[0]+" "+select.split("*")[1]+" "+select.split("*")[2]);
    var table = document.getElementById("tablaPadrinos");
    var rows = table.getElementsByTagName("TR");
    rows[select.split("*")[2]].getElementsByTagName("TD")[4].innerHTML=select.split("*")[0];

     var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
        type: "POST",
        url: url,
        data: "&tipo=Apadrinar"+"&idPadrino="+select.split("*")[2]+"&idAlumno="+select.split("*")[1], // Adjuntar los campos del formulario enviado.
        success: function (data) {
            if (!data.includes("Error")) {
                check("success", "OK", "El alumno "+select.split("*")[0]+" fue apadrinado correctamente");
            } else {
                //tipo,titulo,mensaje
                check("error", "Error al resgistrar el apadrinaje", data);
            }
        }
    });
    limpiarModalAlumnos();
}
/**
 * No se desea hacer la asociacion entre parino y ahijado
 */
function limpiarModalAlumnos() {
    var table = document.getElementById("tablaAlumnosLibres");
    var rows = table.getElementsByTagName("TR");
    var rowCount = rows.length;
    if(rowCount>0){
        for (var x = rowCount - 1; x > 0; x--) {
                table.deleteRow(x);
        }
    }
}
/**
 * Para que la tabla de Padrinos libres se ordene
 * @param {[[Type]]} n [[Description]]
 */
function ordenarTablaPadrinosLibres(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tablaPadrinos");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
             if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                   shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
function ordenarTablaAlumnosLibres(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tablaAlumnosLibres");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
           rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
