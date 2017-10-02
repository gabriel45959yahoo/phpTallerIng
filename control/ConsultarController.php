<?php
include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
class ConsultarController{

    function buscarAllPadrinoLibres(){
         $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->buscarPadrinosLibres(null);
        if(count($restPadrino)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($restPadrino);
        }

    }
 function buscarAllAlumnosLibres(){
         $alumnoSingleton = ABMAlumno::singleton_Alumno();

        // accedemos al método cargar padrino
        $restAlumno = $alumnoSingleton->buscarAlumnosLibres(null);
        if(count($restAlumno)==0){
            return "Error: No se encontraron padrinos";
        }else{

            return json_encode($restAlumno);
        }

    }



}

?>
