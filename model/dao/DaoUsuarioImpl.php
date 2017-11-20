<?php

namespace model\dao;

use model\entities\UsuarioEntity;
use model\entities\RolEntity;
include '../model/dao/DaoUsuario.php';


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
    public function update($datos) {

        $conexion = DaoConnection::connection();



      /*  if ($usuario!=null && $columna!=null && $valor!=null) {

             switch ($columna) {
                //Pantalla administrar usuario
                case "usuario":
                    $columna="usr_id";
                    break;
                case "nombre":
                    $columna="nombre";
                    break;
                 case "apellido":
                    $columna="apellido";
                    break;
                case "email":
                    $columna="email";
                    break;
            }*/

            $consulta = "UPDATE usuario SET nombre='$datos[1]' ,apellido='$datos[2]',email='$datos[3]'   WHERE usr_id='$datos[0]'";


            mysqli_query($conexion, $consulta);
            mysqli_close($conexion);
            return true;
        //}
      //  return false;
    }
    public function crearUsuario($user) {
        
    }

    public function insert($obj) {
        
        $conexion = DaoConnection::connection();

         $sql = "INSERT INTO usuario(usr_id, usr_id_rol, nombre, apellido, email, clave) VALUES ('$obj->usuario','$obj->rol','$obj->nombre','$obj->apellido','$obj->email','$obj->clave')";



        if ($conexion->query($sql) === TRUE) {
            mysqli_commit($conexion);
            mysqli_close($conexion);

            return "OK";
        } else {
            $error = $conexion->error;
            mysqli_rollback($conexion);
            mysqli_close($conexion);
            return "Error: " . $error;
        }
    }

    public function select($obj) {
        $resultado = array();
        $conexion = DaoConnection::connection();
       // echo $obj->usuario;
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
              //  $re = array_map('utf8_encode',$re);
                $rol=new RolEntity(null,$re[4],$re[5]);
                //$nombre, $apellido, $usuario, $clave, $rol, $email
                $resultado["data"][]= new UsuarioEntity($re[1],$re[2],$re[0],null,$rol,$re[3]);
            }
       }
      //  echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
   public function selectRol() {
        $resultado = array();
        $conexion = DaoConnection::connection();


        $sql="SELECT rol_id,rol_name,rol_descripcion FROM rol_usr_fun";

          $result = mysqli_query($conexion, $sql);
       // echo mysqli_num_rows($result);
       if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($re = mysqli_fetch_row($result)) {
                //$re = array_map('utf8_encode',$re);
                $rol=new RolEntity($re[0],$re[1],$re[2]);

                $resultado["data"][]= $rol;
            }
       }
      //  echo $conexion->error;
        mysqli_close($conexion);
     return   $resultado;
    }
}

?>
