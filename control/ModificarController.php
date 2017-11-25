<?php
use model\ABMDatosFactura;
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
    function modificarPadrino($datos){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        
         $rest = $padrinoSingleton->modificarPadrino(explode(",", $datos));
        if($rest="OK"){
            return "Los datos se actualizaron correctamente";
        }
        return $rest;
    }
    function modificarDomicilioPadrino($domicilio){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        
         $rest = $padrinoSingleton->modificarDomicilioPadrino($domicilio);
        if($rest="OK"){
            return "Los datos se actualizaron correctamente";
        }
        return $rest;
    }
    function modificarDatosFacturacion($datos){
        
        $facturaSingleton = ABMDatosFactura::singleton_DatosFactura();
        
         $rest = $facturaSingleton->modificarDatosFacturacion(explode(",", $datos));
        
        if($rest="OK"){
            return "Los datos se actualizaron correctamente";
        }
        return $rest;        
    }
    function finCicloLectivo($idVinculacion) {

         $vincularSingleton = ABMVincular::singleton_Vincular();
            
         $rest = $vincularSingleton->anularVinculacion($idVinculacion);
         

            if ($rest == 0) {
                return "Se finalizo el ciclo lectivo.";
            } else {
                return "Error: al Finalizar el ciclo lectivo.";
            }
         
    }
}
   
?>
