<?php
session_start();
include '../model/entities/PadrinoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../model/ABMPadrino.php';
include '../model/ABMDatosFactura.php';

//control de session
if (! isset($_SESSION['session'])) {
    
    header('Location: https://tallermr2g.000webhostapp.com/index.html');
    
    exit();
}
//cuando quiero hacer una accion al momento de hacer para un tipo Alumno
if (isset($_POST["tipo"]) && $_POST["tipo"] == "Alumno") {
    

//cuando quiero hacer una accion al momento de hacer para un tipo Padrino
} else if (isset($_POST["tipo"]) && $_POST["tipo"] == "Padrino") {
   
        $padrinoSingleton = ABMPadrino::singleton_Padrino();

        // $calle,$numero,$piso,$depto,$provincia,$ciudad
        $domicilio= new model\entities\DomicilioEntity(0,$_POST['calle'], (int) $_POST['numero'], $_POST['piso'],
                                  $_POST['depto'], $_POST['provincia'], $_POST['ciudad']);

        $domicilioFact= new model\entities\DomicilioEntity(0,$_POST['fact_calle'], (int) $_POST['fact_numero'], $_POST['fact_piso'],
                                  $_POST['fact_depto'], $_POST['fact_provincia'], $_POST['fact_ciudad']);
        
         //$nombre,$apellido,$dni,$email,$cuil,$telefono,$domicilio)
        $factDatos= new model\entities\DatosFactEntity(0,$_POST['fact_nombre'], $_POST['fact_apellido'],
                                     (int)$_POST['fact_dni'],  $_POST['fact_email'],
                                     (int)$_POST['fact_cuil'], (int)$_POST['fact_telefono'],$domicilioFact);

         // $nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
        $padrino = new PadrinoEntity($_POST['nombre'], $_POST['apellido'],
                                     $_POST['alias'], (int) $_POST['dni'],
                                     $_POST['cuil'], $_POST['email'],
                                    (int) $_POST['telefono'], $_POST['contacto'],$domicilio,$factDatos);

        //Si almenos un dato esta cargado en la pantalla realizao el insert
        if (!$_POST["fact_nombre"]==null){
            $facturaSingleton=model\ABMDatosFactura::singleton_DatosFactura();

            // accedemos al método cargar padrino
            $usr = $facturaSingleton->cargarDatosFactura($padrino);
            if($usr){
                echo "Datos de facturacion se cargados correctamente";
            }else{
                echo "Los datos de facturacion no se pudieron cargar";
            }

        }

        // accedemos al método cargar padrino
        $usr = $padrinoSingleton->cargarPadrino($padrino);
        if($usr){
            echo "Datos del Padrino cargados correctamente";
        }else{
            echo "Los datos del Padrino no se pudieron cargar";
        }

    
}

?>
