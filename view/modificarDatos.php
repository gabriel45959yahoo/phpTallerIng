<?php
session_start();
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\VincularEntity as VincularEntity;
include '../model/entities/PadrinoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../model/entities/AlumnoEntity.php';
include '../model/entities/TipoPagoEntity.php';
include '../model/entities/DetallePagoEntity.php';
include '../model/entities/PagoRealizadoEntity.php';
include '../model/entities/EstadoPlan.php';
include '../model/entities/VincularEntity.php';
include '../model/entities/PorcLibOcup.php';
include '../control/ModificarController.php';

function modificarUsuario(){
    $modificarController = new ModificarController();

    echo $modificarController->modificarUsuario($_POST['usuario'],$_POST['column_name'],$_POST['value']);

}


if (! isset($_SESSION['session'])) {

    header('Location: https://tallermr2g.000webhostapp.com/index.html');

    exit();
}else{

    //se la session es valida realizamos la siguiente accion
    if(isset($_POST["tipo"])){

        switch ($_POST["tipo"]) {
                //Pantalla administrar usuario
                case "datosUsuarios":
                    modificarUsuario();
                    break;

                default:
                    echo "{\"data\":[\"Error no llego parametro\"]}"+$_POST["tipo"];
            }
    }
}
?>
