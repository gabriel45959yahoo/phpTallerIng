<?php
session_start();
use model\entities\PadrinoEntity as PadrinoEntity;
use model\entities\AlumnoEntity as AlumnoEntity;
use model\entities\PlanPactadoEntity as PlanPactadoEntity;
use model\entities\ApadrinajeEntity as ApadrinajeEntity;


include '../model/entities/PadrinoEntity.php';
include '../model/entities/AlumnoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../model/entities/PlanPactadoEntity.php';
include '../model/entities/ApadrinajeEntity.php';
include '../control/CargarController.php';



function cargarPadrino(){
    $cargarController = new CargarController();
   // $calle,$numero,$piso,$depto,$provincia,$ciudad
        $domicilio= new model\entities\DomicilioEntity(0,$_POST['calle'], (int) $_POST['numero'], $_POST['piso'],
                                  $_POST['depto'], $_POST['provincia'], $_POST['ciudad']);

        $domicilioFact= new model\entities\DomicilioEntity(0,$_POST['fact_calle'], (int) $_POST['fact_numero'], $_POST['fact_piso'],
                                  $_POST['fact_depto'], $_POST['fact_provincia'], $_POST['fact_ciudad']);

         //$id,$nombre,$apellido,$dni,$cuil,$domicilio
        $factDatos= new model\entities\DatosFactEntity(0,ucwords($_POST['fact_nombre']), ucwords($_POST['fact_apellido']),(int)$_POST['fact_dni'], (int)$_POST['fact_cuil'],$domicilioFact);


         $fichaFisica=0;

        if(isset($_POST['fichaFisica'])){
            $fichaFisica=$_POST['fichaFisica'];
        }

         // $nombre,$apellido,$alia,$dni,$cuil,$email,$emailAlt,$telefono,$telefonoAlt,$contacto,$domicilio,$domicilioFact,$montoPactado,$fichaFisicaIngreso
         $padrino = new PadrinoEntity(ucwords($_POST['nombre']), ucwords($_POST['apellido']),
                                     ucwords($_POST['alias']), (int) $_POST['dni'],
                                     $_POST['cuil'], $_POST['email'],$_POST['email_alt'],
                                    (int) $_POST['telefono'], (int) $_POST['telefono_alt'], $_POST['contacto'],$domicilio,$factDatos,$_POST['monto_pactado'],$fichaFisica);

        echo $cargarController->cargarPadrino($padrino);

}

function cargarAlumno(){
        $cargarController = new CargarController();
     //$nombre,$apellido,$dni,$nivelCurso,$observaciones,$fechaNacimiento
        $alumno= new AlumnoEntity(ucwords($_POST['nombre']), ucwords($_POST['apellido']),ucwords($_POST['alias']),
                                     (int)$_POST['dni'],  $_POST['nivelCurso'],
                                      $_POST['observaciones'], $_POST['fechaNacimiento']);

         echo $cargarController->cargarAlumno($alumno);
}


function cargarApadrinaje(){
    $cargarController = new CargarController();

    if($_POST['idPadrino']==''||$_POST['idAlumno']==''){
        echo "Error: faltan los datos del Alumno ó el Padrino";
    }else{
        //$idPadrino,$idAlumno,$seConocen,$observaciones
        $apadrinar = new ApadrinajeEntity($_POST['idPadrino'],$_POST['idAlumno'],$_POST['seConocen'],$_POST['observacion']);

        echo $cargarController->apadrinar($apadrinar);
    }
}


/***
 Control de session
***/
if (! isset($_SESSION['session'])) {

    header('Location: https://tallermr2g.000webhostapp.com/index.html');

    exit();
}else{

   //se la session es valida realizamos la siguiente accion
    if(isset($_POST["tipo"])){

        switch ($_POST["tipo"]) {
                case "Alumno":
                    cargarAlumno();
                    break;
                case "Padrino":
                    cargarPadrino();
                    break;
                case "Apadrinar":
                    cargarApadrinaje();
                    break;
            }
    }





}

?>
