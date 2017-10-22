<?php
session_start();
include '../model/Login.php';

if(!isset($_SESSION['session']))
{
    
//     echo "<script> window.location.assign('/index.html'); </script>";
    
    $response= 'no login';

} else{
   // $nuevoSingleton = Login::singleton_login();

  //  $user=$nuevoSingleton->rol_users($_SESSION['session']);

    $usuario=$_SESSION['session'];

    $rol= array();

    $rol=$_SESSION['sessionRol'];

    $menu='<nav class="navbar navbar-inverse">'.
            '<div class="container-fluid">'.
                '<div class="navbar-header">'.
                    '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myMenuNavbar">'.
        '<span class="icon-bar"></span>'.
        '<span class="icon-bar"></span>'.
        '<span class="icon-bar"></span></button> '.
        '<a class="navbar-brand" href="../view/home.html"> <img  src="/resource/images/Logo_effeta.png"></a>'.
         '</div>'.
         '<div class="collapse navbar-collapse" id="myMenuNavbar">'.
         '<ul class="nav navbar-nav">'.
         '<li class="active"><a href="../view/home.html">Home</a></li>';
    if($rol=="ADMIN"){

         $menu=$menu.'<li class="dropdown">'.
         '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Cargar </a>'.
         '<ul class="dropdown-menu">'.
         '<li><a href="/view/CargarAlumno.html">Alumno</a></li>'.
         '<li><a href="/view/CargarPadrino.html">Padrino</a></li>'.
         '</ul></li>'.
         '<li><a href="/view/CargarPago.html">Pagos</a></li>'.
         '<li><a href="/view/AdministrarUsuario.html">Administrar Usuarios</a></li>'.
         '<li><a href="#">Listados</a></li>'.
         '<li><a href="/view/Vincular.html">Vincular</a></li>'.'</ul>';
    }else{
        $menu=$menu.'<li class="dropdown">'.
         '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Cargar </a>'.
         '<ul class="dropdown-menu">'.
         '<li><a href="/view/CargarAlumno.html">Alumno</a></li>'.
         '<li><a href="/view/CargarPadrino.html">Padrino</a></li>'.
         '</ul></li>'.
         '<li><a href="#">Listados</a></li>'.
         '<li><a href="/view/Vincular.html">Vincular</a></li>'.'</ul>';
    }

    $menu=$menu.'<ul class="nav navbar-nav navbar-right">'.
         '<li class="dropdown">'.
         '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user">&nbsp;</span>'.$usuario.'</a>'.
         '<ul class="dropdown-menu">'.
         '<li><a href="/view/CambioDeClave.html">Cambiar Clave</a></li>'.
        '<li><a onclick="logout()"><span class="glyphicon glyphicon-log-out">&nbsp;</span>salir</a></li>'.
         '</ul></li>'.
          '</ul>'.
         '</div></div></nav>';


    $response = $menu;
}
//json_encode(array('response' => $response))
echo $response;
?>
