<?php
/*
 * include '../model/entities/PadrinoEntity.php';
 * include '../model/ABMPadrino.php';
 *
 *
 *
 * function cargarPadrino(){
 * $padrinoSingleton = ABMPadrino::singleton_Padrino();
 * //$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
 * $padrino = new PadrinoEntity($_POST['padrino_nombre'],$_POST['apellido'],
 * $_POST['alia'],(int)$_POST['dni'],
 * $_POST['cuil'],$_POST['email'],
 * (int)$_POST['telefono'],$_POST['contacto']);
 *
 * //accedemos al método cargar padrino
 * $usr = $padrinoSingleton->cargarPadrino($padrino);
 * }
 *
 *
 * if(isset($_POST['padrino_nombre'])) {
 *
 * cargarPadrino();
 *
 * }
 */
session_start();
if(!isset($_SESSION['session']))
{
    
    header('Location: https://tallermr2g.000webhostapp.com/index.html');
    
    exit();
} 
   

?>
