<?php
include '../model/entities/PadrinoEntity.php';
include '../model/ABMPadrino.php';

$padrinoSingleton = ABMPadrino::singleton_Padrino();

  //$nombre,$apellido,$alia,$dni,$cuil,$email,$telefono,$contacto
    $padrino = new PadrinoEntity($_POST['nombre'],$_POST['apellido'],
                                 $_POST['alia'],$_POST['dni'],
                                 $_POST['cuil'],$_POST['email'],
                                 $_POST['telefono'],$_POST['contacto']);

    //accedemos al método cargar padrino
    $usr = $padrinoSingleton->cargarPadrino($padrino);

   /* if($usr == TRUE)
    {
       // header("Location: /view/CargarPadrino.html");
         echo "<script> window.location.assign('/view/CargarPadrino.html'); </script>";

    }else{
        echo "<script> window.location.assign('/view/CargarPadrino.html'); </script>";

    }
*/
?>
