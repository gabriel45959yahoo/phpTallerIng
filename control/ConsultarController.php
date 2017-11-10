<?php

include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/ABMVincular.php';
include '../model/ABMDatosFactura.php';
include '../model/ABMPagos.php';
include '../model/ABMPlanPactado.php';
include '../model/Login.php';

class ConsultarController{

    function buscarAllPadrinoLibres(){
         $padrinoSingleton = ABMPadrino::singleton_Padrino();

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
        $vincularSingleton = ABMVincular::singleton_Vincular();

        // accedemos al método cargar padrino
        $rest = $vincularSingleton->listarPadrinoAhijado(null);
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

            return json_encode($restPadrino);

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
    function buscarPadrinosVinculados(){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->buscarPadrinosVinculados();
        if(count($restPadrino)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($restPadrino);
        }
    }
    function listarPlanes(){
         $planPactadoSingleton = ABMPlanPactado::singleton_PlanPactado();

        $rest= $planPactadoSingleton->listarPlanes();
        if(count($rest)==0){
            return "Error: No se encontraron Planes";
        }else{
            return json_encode($rest);
        }

    }
    function listaPlanCompletadoPadrino(){
         $pagosSingleton = ABMPagos::singleton_Pagos();
                // accedemos al método cargar padrino
        $rest = $pagosSingleton->listaPlanCompletadoPadrino();

        return json_encode($rest);

    }
    function buscarHistoricoPadrinosVinculados(){
         $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->buscarHistoricoPadrinosVinculados();
        if(count($restPadrino)==0){
            return "Error: No se encontraron padrinos";
        }else{
            return json_encode($restPadrino);
        }
    }
    function buscarAhijadosdelPadrino($idPadrino){

         $vincularSingleton = ABMVincular::singleton_Vincular();

        // accedemos al método cargar padrino
        $rest = $vincularSingleton->buscarAhijadosdelPadrino($idPadrino);
        if(count($rest)==0){
            return "Error: No se encontraron Alumnos";
        }else{
            return json_encode($rest);
        }
    }
    function detallePagosPadrinos($idVinculado,$fechaDesde,$fechaHasta){
         $pagosSingleton = ABMPagos::singleton_Pagos();

        $rest = $pagosSingleton->detallePagosPadrinos($idVinculado,$fechaDesde,$fechaHasta);

            return json_encode($rest);

    }
    function listarUsuarios(){
        $nuevoSingleton = Login::singleton_login();

         $rest = $nuevoSingleton->listarUsuarios();

        return json_encode($rest);
    }
    function listarRol(){
         $nuevoSingleton = Login::singleton_login();

         $rest = $nuevoSingleton->listarRol();

        return json_encode($rest);
    }
}

?>
