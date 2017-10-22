<?php

namespace model\dao;

use model\entities\UsuarioEntity;
use model\entities\RolEntity;

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
        $resultado = array();
        $conexion = DaoConnection::connection();
        
        if($obj!= null){
            $sql="SELECT usr_id, nombre, apellido, email, rol.rol_name,rol.rol_descripcion FROM usuario usr,rol_usr_fun rol WHERE usr.usr_id_rol=rol.rol_id and usr.usr_id='$obj->usuario';";
        }else {
             $sql="SELECT usr_id, nombre, apellido, email, rol.rol_name,rol.rol_descripcion FROM usuario usr,rol_usr_fun rol WHERE usr.usr_id_rol=rol.rol_id;";
        }
          $result = mysqli_query($conexion, $sql);
       // echo mysqli_num_rows($result);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                $re = array_map('utf8_encode',$re);
                $rol=new RolEntity(null,$re[4],$re[5]);
                //$nombre, $apellido, $usuario, $clave, $rol, $email
                $resultado[]= new UsuarioEntity($re[1],$re[2],$re[0],null,$rol,$re[3]);
            }
       }
      //  echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }

}

?>
