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
        // $nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
        $padrino = new PadrinoEntity($_POST['nombre'], $_POST['apellido'], $_POST['alias'], (int) $_POST['dni'], $_POST['cuil'], $_POST['email'], (int) $_POST['telefono'], $_POST['contacto']);
        echo $_POST['nombre'];
        // accedemos al método cargar padrino
        $usr = $padrinoSingleton->cargarPadrino($padrino);
 

    
}

?>
