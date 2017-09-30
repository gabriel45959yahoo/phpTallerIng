<?php
session_start();
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
include '../model/entities/PadrinoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../control/CargarController.php';
if (! isset($_SESSION['session'])) {

    header('Location: https://tallermr2g.000webhostapp.com/index.html');

    exit();
}else{
    $cargarController = new CargarController();
    //cuando quiero hacer una accion al momento de hacer para un tipo Alumno
    if (isset($_POST["tipo"]) && $_POST["tipo"] == "Alumno") {



        $alumno= new AlumnoEntity(ucwords($_POST['nombre']), ucwords($_POST['apellido']),
                                     (int)$_POST['fact_dni'],  $_POST['fact_email'],
                                     (int)$_POST['fact_cuil'], (int)$_POST['fact_telefono']);

    //cuando quiero hacer una accion al momento de hacer para un tipo Padrino
    } else if (isset($_POST["tipo"]) && $_POST["tipo"] == "Padrino") {
        // $calle,$numero,$piso,$depto,$provincia,$ciudad
        $domicilio= new model\entities\DomicilioEntity(0,$_POST['calle'], (int) $_POST['numero'], $_POST['piso'],
                                  $_POST['depto'], $_POST['provincia'], $_POST['ciudad']);

        $domicilioFact= new model\entities\DomicilioEntity(0,$_POST['fact_calle'], (int) $_POST['fact_numero'], $_POST['fact_piso'],
                                  $_POST['fact_depto'], $_POST['fact_provincia'], $_POST['fact_ciudad']);

         //$nombre,$apellido,$dni,$email,$cuil,$telefono,$domicilio)
        $factDatos= new model\entities\DatosFactEntity(0,ucwords($_POST['fact_nombre']), ucwords($_POST['fact_apellido']),
                                     (int)$_POST['fact_dni'],  $_POST['fact_email'],
                                     (int)$_POST['fact_cuil'], (int)$_POST['fact_telefono'],$domicilioFact);

         // $nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
        $padrino = new PadrinoEntity(ucwords($_POST['nombre']), ucwords($_POST['apellido']),
                                     ucwords($_POST['alias']), (int) $_POST['dni'],
                                     $_POST['cuil'], $_POST['email'],
                                    (int) $_POST['telefono'], $_POST['contacto'],$domicilio,$factDatos);

        echo $cargarController->cargarPadrino($padrino);

    }
}

?>
