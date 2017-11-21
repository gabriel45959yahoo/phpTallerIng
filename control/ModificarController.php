<?php

include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/ABMVincular.php';
include '../model/ABMDatosFactura.php';
include '../model/ABMPagos.php';
include '../model/ABMPlanPactado.php';
include '../model/Login.php';

class ModificarController{

    function modificarUsuario($datos){
        $nuevoSingleton = Login::singleton_login();

         $rest = $nuevoSingleton->modificarUsuario(explode(",", $datos));

        return $rest;
    }
    function modificarAlumno($datos){
         $alumnoSingleton = ABMAlumno::singleton_Alumno();

        $rest = $alumnoSingleton->modificarAlumno(explode(",", $datos));
        if($rest="OK"){
            return "Los datos se actualizaron correctamente";
        }
        return $rest;
    }
}

?>
