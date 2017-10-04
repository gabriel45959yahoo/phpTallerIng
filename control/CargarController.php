<?php
include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/ABMDatosFactura.php';
class CargarController{
    
    function cargarPadrino($padrino){
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        $restFact=0;
        $restPadrino=1;
        
        if($padrino->getNombre()=='' || $padrino->getApellido()=='' || $padrino->getAlia()==''||$padrino->getEmail()==''){
            return "Error: Falta completar: Nombre ó Apellido ó Alia ó e-mail";
        }
        if($padrino->getDomicilio()->getNumero()=='' || $padrino->getDomicilio()->getCalle()=='' ){
            return "Error: Falta completar: calle ó número";
        }

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->cargarPadrino($padrino);



        if($restPadrino==-1){
            return "Error: El padrino ya existe.";
        }
        if($restPadrino==0){


            //Si almenos un dato esta cargado en la pantalla realizao el insert
        if (!$_POST["fact_nombre"]==null){
            $facturaSingleton=model\ABMDatosFactura::singleton_DatosFactura();

            // accedemos al método cargar datos de facturacion del padrino
            $restFact = $facturaSingleton->cargarDatosFactura($padrino);

        }
            if($restFact!=0){
                return "Error: al cargar los datos del padrino.";
            }else{
                return "Datos del Padrino fueron cargados correctamente.";
            }
        }else{
            return "Error: al cargar los datos del padrino.";
        }
    }

    function cargarAlumno($alumno){
        $alumnoSingleton = ABMAlumno::singleton_Alumno();
        $restAlumno=1;
        if($alumno->getNombre()=='' || $alumno->getApellido()=='' || $alumno->getDni()==''||$alumno->getFechaNacimiento()==''){
            return "Error: Faltan datos";
        }
         // accedemos al método cargar Alumno
        $restAlumno = $alumnoSingleton->cargarAlumno($alumno);

        if($restAlumno==-1){
            return "Error: El Alumno ya existe.";
        }
        if($restAlumno==0){
            return "Datos del Alumno fueron cargados correctamente.";
        }else{
            return "Error: al cargar los datos del Alumno.";
        }
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
