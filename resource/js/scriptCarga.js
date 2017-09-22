/**
 * Para cargar un alumno
 * @returns
 */
$(function () {
 $("#cargaAlumno").click(function () {
 var url = "../control/CargarController.php"; // El script a dónde se realizará la petición.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formularioAlumno").serialize()+"&tipo=Alumno", // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
           }
         }); 

    return false; // Evitar ejecutar el submit del formulario.
 });
});
/**
 * Para cargar un padrino
 * @returns 
 */ 
$(function(){
	 $("#cargaPadrino").click(function(){
	 var url = "../control/CargarController.php"; // El script a dónde se realizará la petición.
	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $("#formularioPadrino").serialize()+"&tipo=Padrino", // Adjuntar los campos del formulario enviado.
	           success: function(data)
	           {
	               $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
	           }
	         });

	    return false; // Evitar ejecutar el submit del formulario.
	 });
	});
