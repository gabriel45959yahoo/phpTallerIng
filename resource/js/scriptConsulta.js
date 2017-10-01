/**
 * Para consultar padrinos libres
 * @returns
 */
$(function () {
    $("#consultaPadrinosLibres").click(function () {
        var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#formularioPadrinosLibres").serialize() + "&tipo=PadrinosLibres", // Adjuntar los campos del formulario enviado.
            success: function (data) {
                if (!data.includes("Error")) {
                    var content = JSON.parse(data);
                    //$("#formularioPadrinosLibres")[0].reset();//limpia el formulario
                    //tipo,titulo,mensaje
                    check("success", "OK", "Datos recuperados");
                    var n = content.length;
                    var tds;
                    for (var i = 0; i < n; i++) {
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
                } else {
                    //tipo,titulo,mensaje
                    check("error", "Error al cargar los datos", data);
                }

                //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.

            }
        });

        return false; // Evitar ejecutar el submit del formulario.
    });
});

function mostrarModalAlumnos(id) {
    var table = document.getElementById("tablaPadrinos");
    var rows = table.getElementsByTagName("TR");
    var apodo = rows[id].getElementsByTagName("TD")[0];
    var nombre = rows[id].getElementsByTagName("TD")[1];
    var apellido = rows[id].getElementsByTagName("TD")[2];
    //check("info", "", apodo.innerHTML + " " + nombre.innerHTML + " " + apellido.innerHTML);

   $("#apadrinarAlumno").html("Padrino elegido: "+ nombre.innerHTML + " " + apellido.innerHTML); // Mostrar la respuestas del script PHP.
}

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
