<?php
include '../model/dao/DaoConnection.php';
include '../model/dao/DaoUsuario.php';

class DaoUsuarioImpl implements DaoUsuario {

     public function esUsuario($usuario)  {
         $conexion= DaoConnection::connection();
         $usr=$usuario->usuario;
         $clave=$usuario->clave;
         $consulta = "SELECT nombre FROM usuario WHERE usr_id='$usr' AND clave = '$clave'";
        $resultado = mysqli_query($conexion, $consulta);
        $rest = mysqli_fetch_array($resultado);

    if($rest){
        //cierro la conexion a la base de datos
        mysqli_close($conexion);

        return true;
    }else{
        //cierro la conexion a la base de datos
        mysqli_close($conexion);

        return false;
    }

     }
     public function crearUsuario($user){
         
     }
}
?>
