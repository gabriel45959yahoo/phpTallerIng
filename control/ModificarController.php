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

}

?>
