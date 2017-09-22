<?php
session_start();
include '../model/entities/PadrinoEntity.php';
include '../model/ABMPadrino.php';

if (! isset($_SESSION['session'])) {
    
    header('Location: https://tallermr2g.000webhostapp.com/index.html');
    
    exit();
}
if (isset($_POST["tipo"]) && $_POST["tipo"] == "Alumno") {
    
    
} else if (isset($_POST["tipo"]) && $_POST["tipo"] == "Padrino") {
   
        $padrinoSingleton = ABMPadrino::singleton_Padrino();
        // $calle,$numero,$piso,$depto,$provincia,$ciudad
        $domicilio= new Domicilio($_POST['calle'], (int) $_POST['numero'], 
                                  $_POST['depto'], $_POST['provincia'], $_POST['ciudad']);
        
        // $nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
        $padrino = new PadrinoEntity($_POST['nombre'], $_POST['apellido'],
                                     $_POST['alias'], (int) $_POST['dni'], 
                                     $_POST['cuil'], $_POST['email'], 
                                    (int) $_POST['telefono'], $_POST['contacto'],$domicilio);
        
        
        // accedemos al método cargar padrino
        $usr = $padrinoSingleton->cargarPadrino($padrino);
        if($usr){
            echo "Datos cargados correctamente";
        }else{
            echo "Los datos no se pudieron cargar";
        }

    
}

?>
