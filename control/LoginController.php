<?php
include '../model/Login.php';

$nuevoSingleton = Login::singleton_login();

if(isset($_POST['usuario']))
{
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    //accedemos al método usuarios y los mostramos
    $usr = $nuevoSingleton->login_users($usuario,$clave);

    if($usr == TRUE)
    {
       // header("Location: /view/CargarPadrino.html");
         echo "<script> window.location.assign('/view/CargarPadrino.html'); </script>";

    }else{
         echo "<script> window.location.assign('/index.html'); </script>";

    }
}
?>
