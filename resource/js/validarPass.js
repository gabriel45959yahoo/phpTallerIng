function Validar(){    
        
    
        var claveActual, claveNueva, confNueva;        
        

        claveActual = document.getElementById('actual').value;
        claveNueva = document.getElementById('nueva').value;
        confNueva = document.getElementById('cnueva').value;

        if (claveActual == "" || claveNueva == "" || confNueva == "") {
            alert("Campos vacíos, volviendo a Home");
        } else if (claveNueva != confNueva) {
            alert("Las claves nuevas no coinciden, volviendo a Home");
        }
    }








