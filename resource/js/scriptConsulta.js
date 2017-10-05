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
                    //$("#formularioPadrinosLibres")[0].reset();//limpia el formulario
                    //tipo,titulo,mensaje
                    //check("success", "OK", "Datos recuperados");
                    var n = content.length;

                    var tds = '<tbody> ';
                    for (var i = 0; i <= n-1; i++) {
                        tds = '<tr>';
                        tds += '<td>' + content[i].alia + '</td>';
                        tds += '<td>' + content[i].nombre + '</td>';
                        tds += '<td>' + content[i].apellido + '</td>';
                        tds += '<td>' + content[i].dni + '</td>';
                        /* tds += '<td>' + content[i].contacto + '</td>';*/
                        tds += '<td>' + content[i].fechaAlta.split(" ")[0] + '</td>';
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

                //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.

            }
        });

        return false; // Evitar ejecutar el submit del formulario.
}


/**
 * Para mostrar la pantalla de alumnos a seleccionar para el padrino libre elegido
 * @param {[[Type]]} id [[Description]]
 */
function mostrarModalAlumnos(id) {
    cancelarModalAlumnos();
    var table = document.getElementById("tablaPadrinos");
    var rows = table.getElementsByTagName("TR");
    var apodo = rows[id].getElementsByTagName("TD")[0];
    var nombre = rows[id].getElementsByTagName("TD")[1];
    var apellido = rows[id].getElementsByTagName("TD")[2];
    //check("info", "", apodo.innerHTML + " " + nombre.innerHTML + " " + apellido.innerHTML);

    $("#apadrinarAlumno").html("Padrino elegido: " + nombre.innerHTML + " " + apellido.innerHTML); // Mostrar la respuestas del script PHP.

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
                    //tds += '<td contenteditable="true"><input type="radio" value="' + alumno + '" checked> ' + alumno + '<br></td>';
                   // tds += '<td><label for="' + content[i].id + '"><input type="checkbox" name="' + content[i].id + '" id="' + content[i].id + '" value="' + alumno + '" />' + alumno + '</label></td>';
                    tds +='<td><input type="radio" name="radioAlumno" value="' + content[i].id + '"></td>';
                    tds +='<td>' + alumno + '</td>';
                    tds += '</tr>';
                    $("#tablaAlumnosLibres").append(tds);
                }

            } else {
                //tipo,titulo,mensaje
                check("error", "Error al cargar los datos", data);
            }

            //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.

        }
    });

}
/**
 * Cuando se guarda la asociacion entre padrino y alumno
 */
function guardarApadrinaje() {
    cancelarModalAlumnos();
}
/**
 * No se desea hacer la asociacion entre parino y ahijado
 */
function cancelarModalAlumnos() {
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
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tablaPadrinos");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
