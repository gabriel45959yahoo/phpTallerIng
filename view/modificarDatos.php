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

  echo $modificarController->modificarUsuario($_POST['row']);

}
function modificarAlumno(){
  $modificarController = new ModificarController();


  echo $modificarController->modificarAlumno($_POST['row']);

}
function modificarPadrino(){
  $modificarController = new ModificarController();


  echo $modificarController->modificarPadrino($_POST['row']);

}
function modificarDomicilioPadrino(){
    $modificarController = new ModificarController();
     
    $domicilio= new model\entities\DomicilioEntity($_POST['idDomicilio'],$_POST['dom_calle'], (int) $_POST['dom_numero'], $_POST['dom_piso'],
                                  $_POST['dom_depto'], $_POST['dom_provincia'], $_POST['dom_ciudad']);
    
  echo $modificarController->modificarDomicilioPadrino($domicilio);
}
function modificarDatosFacturacion(){
  $modificarController = new ModificarController();


  echo $modificarController->modificarDatosFacturacion($_POST['row']);

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
                //Pantalla modificarAlumnos
                case "datosAlumnos":
                    modificarAlumno();
                    break;
                 //Pantalla modificarPadrino
                case "datosPadrino":
                    modificarPadrino();
                    break;
                 //Pantalla modificarPadrino
                case "domicilioPadrino":
                    modificarDomicilioPadrino();
                    break;
                case "datosFacturacion":
                    modificarDatosFacturacion();
                    break;
                default:
                    echo "{\"data\":[\"Error no llego parametro\"]}"+$_POST["tipo"];
            }
    }
}
?>
