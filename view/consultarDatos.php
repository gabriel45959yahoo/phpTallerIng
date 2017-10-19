<?php
session_start();
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\ApadrinajeEntity as ApadrinajeEntity;
include '../model/entities/PadrinoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../model/entities/AlumnoEntity.php';
include '../model/entities/TipoPagoEntity.php';
include '../model/entities/ApadrinajeEntity.php';
include '../model/entities/PorcLibOcup.php';
include '../control/ConsultarController.php';


function alumnosLibres(){
      $consultarController = new ConsultarController();

      echo $consultarController->buscarAllAlumnosLibres();
}
function padrinosLibres(){
    $consultarController = new ConsultarController();

    echo $consultarController->buscarAllPadrinoLibres();
}
function listarPadrinoAhijado(){
     $consultarController = new ConsultarController();

    echo $consultarController->listarPadrinoAhijado();

}
function listarDomFactPorPadrino(){
     $consultarController = new ConsultarController();

    echo $consultarController->listarDomFactPorPadrino($_POST['idPadrino']);
}
function listarTipoPago(){
     $consultarController = new ConsultarController();

    echo $consultarController->listarTipoPago();
}
function listarPadrinoLibrePadrinoOcupado(){
     $consultarController = new ConsultarController();

    echo $consultarController->listarPadrinoLibrePadrinoOcupado();
}
function buscarPadrinosVinculados(){
      $consultarController = new ConsultarController();

    echo $consultarController->buscarPadrinosVinculados();
}

function listarPlanes(){
      $consultarController = new ConsultarController();

    echo $consultarController->listarPlanes();
}


if (! isset($_SESSION['session'])) {

    header('Location: https://tallermr2g.000webhostapp.com/index.html');

    exit();
}else{

    //se la session es valida realizamos la siguiente accion
    if(isset($_POST["tipo"])){

        switch ($_POST["tipo"]) {
                //Pantalla Vincular
                case "AlumnosLibres":
                    alumnosLibres();
                    break;
                //Pantalla vincular
                case "PadrinosLibres":
                    padrinosLibres();
                    break;
                //Pantalla Pagos
                case "ListarPadrinoAhijado":
                    listarPadrinoAhijado();
                    break;
                //Pantalla Pagos
                case "ListarDomFactPadrino":
                    listarDomFactPorPadrino();
                    break;
                //Pantalla Pagos
                 case "ListarTipoPago":
                    listarTipoPago();
                    break;
                // para grafico de torta
                 case "PadrinoAlumnoLibreOcupado":
                    listarPadrinoLibrePadrinoOcupado();
                    break;
                // para pantalla vincular (para desvincular)
                 case "listarPadrinosVinculados":
                    buscarPadrinosVinculados();
                    break;
                 // para pantalla vincular (para desvincular)
                 case "Planes":
                    listarPlanes();
                    break;
                default:
                    echo "{\"data\":[\"Error no llego parametro\"]}"+$_POST["tipo"];
            }
    }


}

?>
