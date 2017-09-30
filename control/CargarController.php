<?php
include '../model/ABMPadrino.php';
include '../model/ABMDatosFactura.php';
class CargarController{
    
    function cargarPadrino($padrino){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        $restFact=false;
        $restPadrino=false;
        
        if($padrino->getNombre()=='' || $padrino->getApellido()=='' || $padrino->getAlia()==''||$padrino->getEmail()==''){
            return "Error: Falta completar: Nombre ó Apellido ó Alia ó e-mail";
        }
        if($padrino->getDomicilio()->getNumero()=='' || $padrino->getDomicilio()->getCalle()=='' ){
            return "Error: Falta completar: calle ó número";
        }
        //Si almenos un dato esta cargado en la pantalla realizao el insert
        if (!$_POST["fact_nombre"]==null){
            $facturaSingleton=model\ABMDatosFactura::singleton_DatosFactura();

            // accedemos al método cargar padrino
            $restFact = $facturaSingleton->cargarDatosFactura($padrino);
          /*  if($usr1){
                echo "Datos de facturacion se cargados correctamente";
            }else{
                echo "Los datos de facturacion no se pudieron cargar";
            }*/

        }

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->cargarPadrino($padrino);
        if($restPadrino==null){
            return "Error: El padrino ya existe.";
        }
        if($restPadrino || $restFact){
            return "Datos del Padrino cargados correctamente.";
        }else{
            return "Error: al cargar los datos del padrino.";
        }
    }
    function cargarAlumno($alumno){

    }
    function cargarPagos($pagos){

    }
    function cargarPlanPactado($plan){

    }
    function cargarUsuario($usuario){

    }
    function apadrinar($apadrinar){

    }
    function cancelarApadrinaje($apadrinar){

    }
}
?>
