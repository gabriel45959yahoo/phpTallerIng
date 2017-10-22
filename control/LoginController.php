<?php

if (!isset($_SESSION)) {
    session_start();
}
include '../model/Login.php';
$nuevoSingleton = Login::singleton_login();
if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    //accedemos al método usuarios y los mostramos
    $usr = $nuevoSingleton->login_users($usuario, $clave);

    if ($usr == TRUE) {
        $_SESSION['session'] = $usuario;
        $_SESSION['sessionRol']=$nuevoSingleton->rol_users($_SESSION['session'])[0]->getRol()->nombre;
        echo $usuario;
    } else {
        echo "Error de usuario o password";
    }
}
?>
