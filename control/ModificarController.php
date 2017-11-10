<?php

include '../model/ABMPadrino.php';
include '../model/ABMAlumno.php';
include '../model/ABMVincular.php';
include '../model/ABMDatosFactura.php';
include '../model/ABMPagos.php';
include '../model/ABMPlanPactado.php';
include '../model/Login.php';

class ModificarController{

    function modificarUsuario($usuario,$columna,$valor){
        $nuevoSingleton = Login::singleton_login();

         $rest = $nuevoSingleton->modificarUsuario($usuario,$columna,$valor);

        return json_encode($rest);
    }

}

?>
