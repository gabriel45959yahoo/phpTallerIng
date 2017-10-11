<?php

use model\dao\DaoUsuarioImpl;

include '../model/dao/DaoUsuarioImpl.php';
include '../model/entities/UsuarioEntity.php';

class CambioClaveController {

    public static function cambioClave() {
        session_start();
        $daoUsuario = new DaoUsuarioImpl();
        $nombreUsr = $_SESSION['session'];
        $claveActual = $_POST['actual'];
        $claveNueva = $_POST['nueva'];
        $confirmacion = $_POST['cnueva'];
        if ($daoUsuario->cambiarClave($nombreUsr, $claveActual, $claveNueva, $confirmacion)) {            
            echo "<script> window.location.assign('../index.html'); </script>";
        } else {            
            echo "<script> window.location.assign('../view/home.html'); </script>";
        }
    }

}

CambioClaveController::cambioClave(); //Llamo al metodo
