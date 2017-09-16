<?php
include '../model/login.class.php';


$nuevoSingleton = Login::singleton_login();

if(isset($_POST['nick']))
{
    $nick = $_POST['nick'];
    $password = $_POST['password'];
    //accedemos al método usuarios y los mostramos
    $usuario = $nuevoSingleton->login_users($nick,$password);

    if($usuario == TRUE)
    {
        header("Location:https://tallermr2g.000webhostapp.com/view/home.php");
    }
}
?>
