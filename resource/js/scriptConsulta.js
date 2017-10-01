/**
 * Para consultar padrinos libres
 * @returns
 */
$(function(){
	 $("#consultaPadrinosLibres").click(function(){
	 var url = "../view/consultarDatos.php"; // El script a dónde se realizará la petición.
	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $("#formularioPadrinosLibres").serialize()+"&tipo=PadrinosLibres", // Adjuntar los campos del formulario enviado.
	           success: function(data)
	           {
                   if(!data.includes("Error")){
                       var content = JSON.parse(data);
                        //$("#formularioPadrinosLibres")[0].reset();//limpia el formulario
                        //tipo,titulo,mensaje
                       check("success","OK","Datos recuperados");
                       var n=content.length;
                       var tds;
                       for(var i=0;i<n;i++){
                           tds='<tr>';
                           tds+='<td>'+content[i].alia+'</td>';
                           tds+='<td>'+content[i].nombre+'</td>';
                           tds+='<td>'+content[i].apellido+'</td>';
                           tds+='<td>'+content[i].dni+'</td>';
                           tds+='<td>'+content[i].contacto+'</td>';
                           tds+='<td>'+content[i].fechaAlta+'</td>';
                           tds+='</tr>';
                           $("#tablaPadrinos").append(tds);
                       }
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
