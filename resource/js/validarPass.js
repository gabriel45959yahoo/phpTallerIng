$(document).ready(
        function validarPass() {
             
            var claveActual, claveNueva, confNueva;
            
            
            claveActual = document.getElementsByName("actual").value;
            claveNueva = document.getElementsByName("nueva").value;
            confNueva = document.getElementsByName("cnueva").value;
            
            if(claveActual===""||claveNueva===""||confNueva===""){
                alert("Campo vacío");
            }









        }



);


