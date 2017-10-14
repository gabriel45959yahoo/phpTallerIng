<?php
include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/ABMApadrinaje.php';
include '../model/ABMDatosFactura.php';
include '../model/ABMPagos.php';

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
            return "Error: No se encontraron Alumnos";
        }else{
            return json_encode($restAlumno);
        }

    }
    function listarPadrinoAhijado(){
        $apadrinajeSingleton = ABMApadrinaje::singleton_Apadrinaje();

        // accedemos al método cargar padrino
        $rest = $apadrinajeSingleton->listarPadrinoAhijado(null);
        if(count($rest)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($rest);
        }

    }
    function listarDomFactPorPadrino($idPadrino){
        $datosFactSingleton = model\ABMDatosFactura::singleton_DatosFactura();
                // accedemos al método cargar padrino
        $restPadrino = $datosFactSingleton->buscarDomFactPorPadrino($idPadrino);
        if(count($restPadrino)==0){
            return "sin datos";
        }else{
            return json_encode($restPadrino);
        }
    }
    function listarTipoPago(){
         $pagosSingleton = ABMPagos::singleton_Pagos();
                // accedemos al método cargar padrino
        $rest = $pagosSingleton->listarTipoPago();
        if(count($rest)==0){
            return "sin datos";
        }else{
            return json_encode($rest);
        }
    }
    function listarPadrinoLibrePadrinoOcupado(){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->listarPadrinoLibrePadrinoOcupado();
        if(count($restPadrino)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($restPadrino);
        }
    }

}

?>
