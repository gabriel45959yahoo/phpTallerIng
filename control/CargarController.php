<?php

use model\ABMDatosFactura;
use model\ABMPlanPactado;
use model\dao\DaoUsuarioImpl;
use model\entities\ObsVincularEntity as ObsVincularEntity;


//include '../model/dao/DaoUsuarioImpl.php';
//include '../model/entities/UsuarioEntity.php'; //CONTROLAR

include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/Login.php';
include '../model/ABMDatosFactura.php';
include '../model/ABMPlanPactado.php';
include '../model/ABMVincular.php';
include '../model/ABMPagos.php';
include '../model/ABMObsVincular.php';

class CargarController {

    function cargarPadrino($padrino) {
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        $rest = 0;
        $restPadrino = 1;

        if ($padrino->getNombre() == '' || $padrino->getApellido() == '' || $padrino->getAlia() == '' || $padrino->getEmail() == '' || $padrino->getMontoPactado() == '') {
            return "Error: Falta completar: Nombre ó Apellido ó Alia ó e-mail ò monto Pactado";
        }
        if ($padrino->getDomicilio()->getNumero() == '' || $padrino->getDomicilio()->getCalle() == '') {
            return "Error: Falta completar: calle ó número";
        }

        // accedemos al método cargar padrino
        $restPadrino = $padrinoSingleton->cargarPadrino($padrino);



        if ($restPadrino == -1) {
            return "Error: El padrino ya existe.";
        }
        if ($restPadrino == 0) {
            $planPactadoSingleton = ABMPlanPactado::singleton_PlanPactado();

            $rest = $planPactadoSingleton->cargar($padrino);

            //Si almenos un dato esta cargado en la pantalla realizao el insert
            if (!$_POST["fact_nombre"] == null) {
                $facturaSingleton = ABMDatosFactura::singleton_DatosFactura();

                // accedemos al método cargar datos de facturacion del padrino
                $rest = $facturaSingleton->cargarDatosFactura($padrino);
            }
            if ($rest != 0) {
                return "Error: al cargar los datos del padrino.";
            } else {
                return "Datos del Padrino fueron cargados correctamente.";
            }
        } else {
            return "Error: al cargar los datos del padrino.";
        }
    }

    function cargarAlumno($alumno) {
        $alumnoSingleton = ABMAlumno::singleton_Alumno();
        $restAlumno = 1;
        if ($alumno->getNombre() == '' || $alumno->getApellido() == '' || $alumno->getDni() == '' || $alumno->getFechaNacimiento() == '') {
            return "Error: Faltan datos";
        }
        // accedemos al método cargar Alumno
        $restAlumno = $alumnoSingleton->cargarAlumno($alumno);

        if ($restAlumno == -1) {
            return "Error: El Alumno ya existe.";
        }
        if ($restAlumno == 0) {
            return "Datos del Alumno fueron cargados correctamente.";
        } else {
            return "Error: al cargar los datos del Alumno.";
        }
    }

    function cargarPagos($detallePago,$pagoRealizado) {
         $pagosSingleton = ABMPagos::singleton_Pagos();
         $rest= 1;

         if ($detallePago->idTipoPago != 4 && ( $detallePago->facturaAcreditaPago == '' || $detallePago->comprobanteAcreditaPago == '' || $pagoRealizado->montoPago==''||$pagoRealizado->idFechaPago =='')) {
            return "Error: Faltan datos de completar ";
        }

        if ($detallePago->idTipoPago == 4 && ( $detallePago->facturaAcreditaPago == '' || $pagoRealizado->montoPago==''||$pagoRealizado->idFechaPago =='')) {
            return "Error: Faltan datos de completar ";
        }

        $rest=$pagosSingleton->cargarPago($detallePago,$pagoRealizado);

        if ($rest == 0) {
            return "El pago se cargo correctamente.";
        } else {
            return "Error: al cargar los datos del pago.";
        }
        
    }

    function vincular($vincular) {
        $vincularSingleton = ABMVincular::singleton_Vincular();
        $ObsVincularSingleton = ABMObsVincular::singleton_ObsVincular();
        $rest = 1;
        $rest = $vincularSingleton->asociar($vincular);


        if ($rest == 0) {
            if($vincular->observaciones!=''){
                $restVinculacion = $vincularSingleton->buscarAsociacion($vincular);
                $rest = $ObsVincularSingleton->cargarObs(new ObsVincularEntity($restVinculacion[0]->id,$vincular->observaciones));
            }
            if ($rest == 0) {
                return "Se realizo la vnculación correctamente.";
            } else {
                return "Error: al crear la vinculación.";
            }
        } else {
            return "Error: al crear la vinculación.";
        }
    }

    function cancelarVinculacion($idVinculacion,$observaciones) {

         $vincularSingleton = ABMVincular::singleton_Vincular();
         $ObsVincularSingleton = ABMObsVincular::singleton_ObsVincular();
         $rest = 1;
         if($observaciones->observaciones==''){
            return "Error: Se debe cargar una Observación.";
         }

         $rest = $ObsVincularSingleton->cargarObs($observaciones);

         if ($rest == 0) {

            $rest = $vincularSingleton->anularVinculacion($idVinculacion);

            if ($rest == 0) {
                return "Se realizo la desvinculacón correctamente.";
            } else {
                return "Error: al cancelar la vinculacón.";
            }
         } else {
            return "Error: al cancelar la vinculacón.";
         }
    }
    function cargarDatosFacturacion($padrino){
        $facturaSingleton = ABMDatosFactura::singleton_DatosFactura();

        // accedemos al método cargar datos de facturacion del padrino
        $rest = $facturaSingleton->cargarDatosFactura($padrino);

        if ($rest != 0) {
                return "Error: al cargar los datos de facturacion del padrino.";
            } else {
                return "Datos de facturacion del Padrino fueron cargados correctamente.";
        }
    }
    function cargarUsuario($usuario){
        $usuarioSingleton = Login::singleton_login();

        $rest = $usuarioSingleton->cargarUsuario($usuario);

        if ($rest != 0) {
                return "Error: al crear el usuario.";
            } else {
                return "El usuario fue creado correctamente.";
        }
    }
}

?>
