<?php
session_start();
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
include '../model/entities/PadrinoEntity.php';
include '../model/entities/AlumnoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../control/ConsultarController.php';
if (! isset($_SESSION['session'])) {

    header('Location: https://tallermr2g.000webhostapp.com/index.html');

    exit();
}else{
    $consultarController = new ConsultarController();
    //cuando quiero hacer una accion al momento de hacer para un tipo Alumno
    if (isset($_POST["tipo"]) && $_POST["tipo"] == "Alumno") {


    //cuando quiero hacer una accion al momento de hacer para un tipo Padrino
    } else if (isset($_POST["tipo"]) && $_POST["tipo"] == "PadrinosLibres") {


        echo $consultarController->buscarAllPadrinoLibres();

    }
}

?>
