/**
 * Para cargar un alumno
 * @returns
 */
$(function () {
 $("#cargaAlumno").click(function () {
 var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formularioAlumno").serialize()+"&tipo=Alumno", // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               if(!data.includes("Error")){
                        $("#formularioAlumno")[0].reset();//limpia el formulario
                        //tipo,titulo,mensaje
                       check("success","OK",data);
                    }else{
                        //tipo,titulo,mensaje
                        check("error","Error al cargar los datos",data);
                    }

	               //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.

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
	 var url = "../view/cargarDatos.php"; // El script a dónde se realizará la petición.
	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $("#formularioPadrino").serialize()+"&tipo=Padrino", // Adjuntar los campos del formulario enviado.
	           success: function(data)
	           {
                   if(!data.includes("Error")){
                        $("#formularioPadrino")[0].reset();//limpia el formulario
                        //tipo,titulo,mensaje
                       check("success","OK",data);
                    }else{
                        //tipo,titulo,mensaje
                        check("error","Error al cargar los datos",data);
                    }

	               //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.

	           }
	         });

	    return false; // Evitar ejecutar el submit del formulario.
	 });
	});


//Modal *******************************************************************
$(function () {
 $("#pruebaAlerta").click(function () {

            check(document.getElementById('name').value,"titulo","mensaje");  // $("#respuesta").html("Esta es una prueba de gabriel"); // Mostrar la respuestas del script PHP.
              //  $("#myModal").modal();

 });
});
