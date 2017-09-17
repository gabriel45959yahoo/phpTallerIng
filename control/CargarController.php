<?php
include '../model/Login.php';
include '../model/entities/PadrinoEntity.php';
include '../model/ABMPadrino.php';

$nuevoSingleton = ABMPadrino::singleton_Padrino();

if(isset($_POST['CargarPadrino']))
{
    //$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
    $padrino = new PadrinoEntity($_POST['nombre'],$_POST['apellido'],
                                 $_POST['alia'],$_POST['dni'],
                                 $_POST['cuil'],$_POST['email'],
                                 $_POST['telefono'],$_POST['contacto']);

    //accedemos al método cargar padrino
    $usr = $nuevoSingleton->cargarPadrino($padrino);

    if($usr == TRUE)
    {
       // header("Location: /view/CargarPadrino.html");
         echo "Se cargo el padrino";

    }else{
         echo "error al cargar el padrino";

    }
}
?>
