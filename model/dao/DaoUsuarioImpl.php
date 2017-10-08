<?php

namespace model\dao;

use model\entities\UsuarioEntity;


include '../model/dao/DaoConnection.php';
include '../model/dao/DaoUsuario.php';
include '../model/dao/DaoObject.php';




class DaoUsuarioImpl implements DaoUsuario, DaoObject {

    public function esUsuario($usuario) {
        $conexion = DaoConnection::connection();
        $usr = $usuario->usuario;  //encapsulamiento?
        $clave = $usuario->clave; //encapsulamiento?
        $consulta = "SELECT nombre FROM usuario WHERE usr_id='$usr' AND clave = '$clave'";
        $resultado = mysqli_query($conexion, $consulta);
        $rest = mysqli_fetch_array($resultado);
        if ($rest) {
            //cierro la conexion a la base de datos
            mysqli_close($conexion);

            return true;
        } else {
            //cierro la conexion a la base de datos
            mysqli_close($conexion);
            return false;
        }
    }

    public function cambiarClave($nombreUsr, $claveActual, $claveNueva, $confirmacion) {
        $conexion = DaoConnection::connection();
        $usr = new UsuarioEntity();
        $usr->setUsuario($nombreUsr);
        $usr->setClave($claveActual);
        if ($this->esUsuario($usr) && $claveNueva == $confirmacion) {
            $consulta = "UPDATE usuario SET clave='$claveNueva' WHERE usr_id='$nombreUsr'";
            mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            return true;
        }
        return false;
    }

    public function crearUsuario($user) {
        
    }

    public function insert($obj) {
        
    }

    public function select($obj) {
        
    }

}

?>
