<?php
session_start();
include '../model/entities/PadrinoEntity.php';
include '../model/entities/DomicilioEntity.php';
include '../model/entities/DatosFactEntity.php';
include '../model/ABMPadrino.php';

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
        
        // $nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
        $padrino = new PadrinoEntity($_POST['nombre'], $_POST['apellido'],
                                     $_POST['alias'], (int) $_POST['dni'], 
                                     $_POST['cuil'], $_POST['email'], 
                                    (int) $_POST['telefono'], $_POST['contacto'],$domicilio);
        
        
        // accedemos al método cargar padrino
        $usr = $padrinoSingleton->cargarPadrino($padrino);
        if($usr){
            if(isset($_POST["fac_calle"])){
                $datosFacturaSingleton = ABMDatosFactura::singleton_DatosFactura();

                $domicilioFact= new model\entities\DomicilioEntity(0,$_POST['fac_calle'], (int) $_POST['fac_numero'], $_POST['fac_piso'],
                                  $_POST['fac_depto'], $_POST['fac_provincia'], $_POST['fac_ciudad']);

                //$id,$nombre,$apellido,$idPomicilio,$idPadrino,$fechaAlta,$fechaBaja
                $datosFact = new model\entities\DatosFactEntity(0,$_POST['fact_nombre'],$_POST['fact_apellido'],$domicilioFact,$padrino);

                $resDF = $datosFacturaSingleton->cargarDatosFactura($datosFact);

                if($resDF){
                    echo "Datos de facturacion se cargadon correctamente";
                }else{
                    echo "Los datos de facturacion no se pudieron cargar";
                }
            }
            echo "Datos del Padrino cargados correctamente";
        }else{
            echo "Los datos del Padrino no se pudieron cargar";
        }

    
}

?>
