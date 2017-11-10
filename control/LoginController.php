<?php

if (!isset($_SESSION)) {
    session_start();
}
include '../model/entities/Persona.php';
include '../model/dao/DaoObject.php';
include '../model/dao/DaoConnection.php';
include '../model/Login.php';

$nuevoSingleton = Login::singleton_login();
if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    //accedemos al método usuarios y los mostramos
    $usr = $nuevoSingleton->login_users($usuario, $clave);
    $_SESSION['session'] = $usuario;
    if ($usr == TRUE) {
        $resulJson=$nuevoSingleton->rol_users($_SESSION['session']);
        echo $resulJson;
       // echo json_decode($resulJson,true)["data"][0]["usuario"];

        $_SESSION['sessionRol']=json_decode($resulJson,true)["data"][0]["rol"]["nombre"];
    } else {
        echo "Error de usuario o password";
    }
}
?>
